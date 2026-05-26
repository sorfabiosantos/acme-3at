<?php

namespace Source\Core;

use PDO;
use PDOException;
use Source\Core\Connect;

abstract class Model
{
    protected string $table = '';
    protected string $primaryKey = 'id';
    protected array $fillable = [];

    protected ?string $errorMessage = null;

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function selectById(int $id): bool
    {
        $query = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id LIMIT 1";

        try {
            $stmt = Connect::getInstance()->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch();

            if (!$result) {
                $this->errorMessage = "Registro não encontrado.";
                return false;
            }

            // Hidrata o objeto atual com base no resultado
            foreach ($result as $column => $value) {
                $property = $this->snakeToCamel($column); // ex.: category_id -> categoryId
                $setter = 'set' . ucfirst($property);

                if (method_exists($this, $setter)) {
                    $this->{$setter}($value);
                    continue;
                }

                // fallback caso não tenha setter
                if (property_exists($this, $property)) {
                    $this->{$property} = $value;
                }
            }

            return true;
        } catch (PDOException $e) {
            $this->errorMessage = $e->getMessage();
            return false;
        }
    }

    public function selectAll(array $filters = [], ?string $orderBy = 'id', string $direction = 'ASC'): array
    {
        try {
            $query = "SELECT * FROM {$this->table}";
            if (!empty($filters)) {
                $query .= " WHERE ";
                foreach ($filters as $index => $filter) {
                    $query .= $filter;
                    if ($index < count($filters) - 1) {
                        $query .= " AND ";
                    }
                }
            }
            $stmt = Connect::getInstance()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->errorMessage = $e->getMessage();
            return [];
        }
    }

    public function selectPaginator(int $page = 1, int $perPage = 10, array $filters = [], ?string $orderBy = 'id', string $direction = 'ASC'): array
    {
        try {
            $queryCount = "SELECT COUNT(*) as 'count' FROM {$this->table}";

            $query = "SELECT * FROM {$this->table}";
            if (!empty($filters)) {
                $query .= " WHERE ";
                $queryCount .= " WHERE ";
                foreach ($filters as $index => $filter) {
                    $query .= $filter;
                    $queryCount .= $filter;
                    if ($index < count($filters) - 1) {
                        $query .= " AND ";
                        $queryCount .= " AND ";
                    }
                }
            }

            $stmtCount = Connect::getInstance()->query($queryCount);
            $total = $stmtCount->fetch()->count;

            $query .= " ORDER BY {$orderBy} {$direction}";
            $query .= " LIMIT " . ($page - 1) * $perPage . ", {$perPage}";

            $stmt = Connect::getInstance()->query($query);
            $data = $stmt->fetchAll();

            return [
                "page" => $page,
                "perPage" => $perPage,
                "total" => $total,
                "data" => $data
            ];

        } catch (PDOException $e) {
            $this->errorMessage = $e->getMessage();
            return [];
        }
    }

    public function insert(): bool
    {
        try {
            $payload = $this->extractPayloadFromGetters();

            if (empty($payload)) {
                $this->errorMessage = 'Nenhum campo válido para inserção.';
                return false;
            }

            $columns = array_keys($payload); // snake_case
            $placeholders = array_map(fn($col) => ':' . $col, $columns);

            $sql = sprintf(
                "INSERT INTO %s (%s) VALUES (%s)",
                $this->table,
                implode(', ', $columns),
                implode(', ', $placeholders)
            );

            $stmt = Connect::getInstance()->prepare($sql);

            foreach ($payload as $column => $value) {
                $stmt->bindValue(':' . $column, $value);
            }

            $stmt->execute();

            if ($stmt->rowCount() !== 1) {
                $this->errorMessage = 'Falha ao inserir registro.';
                return false;
            }

            // Atualiza id no objeto (se houver setter)
            $newId = (int)Connect::getInstance()->lastInsertId();
            if (method_exists($this, 'setId')) {
                $this->setId($newId);
            } elseif (property_exists($this, 'id')) {
                $this->id = $newId;
            }

            return true;
        } catch (PDOException $e) {
            $this->errorMessage = $e->getMessage();
            return false;
        }
    }

    public function updateById(int $id): bool
    {
        try {
            $payload = $this->extractPayloadFromGetters();

            if (empty($payload)) {
                $this->errorMessage = 'Nenhum campo válido para atualização.';
                return false;
            }

            $setParts = [];
            foreach (array_keys($payload) as $column) {
                $setParts[] = "{$column} = :{$column}";
            }

            $sql = sprintf(
                "UPDATE %s SET %s WHERE %s = :_id",
                $this->table,
                implode(', ', $setParts),
                $this->primaryKey
            );

            $stmt = Connect::getInstance()->prepare($sql);

            foreach ($payload as $column => $value) {
                $stmt->bindValue(':' . $column, $value);
            }
            $stmt->bindValue(':_id', $id);

            $stmt->execute();

            if ($stmt->rowCount() < 1) {
                $this->errorMessage = 'Registro não encontrado ou sem alterações.';
                return false;
            }

            return true;
        } catch (PDOException $e) {
            $this->errorMessage = $e->getMessage();
            return false;
        }
    }

    public function deleteById(int $id): bool
    {
        try {
            $query = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
            $stmt = Connect::getInstance()->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            if ($stmt->rowCount() < 1) {
                $this->errorMessage = "Registro não encontrado ou inativo.";
                return false;
            }
            return true;
        } catch (PDOException $e) {
            $this->errorMessage = $e->getMessage();
            return false;
        }
    }

    public function softDeleteById(int $id): bool
    {
        try {
            $query = "UPDATE {$this->table} SET active = 0 WHERE {$this->primaryKey} = :id";
            $stmt = Connect::getInstance()->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() < 1) {
                $this->errorMessage = "Registro não encontrado ou já inativo.";
                return false;
            }
            return true;

        } catch (PDOException $e) {
            $this->errorMessage = $e->getMessage();
            return false;
        }
    }

    protected function extractPayloadFromGetters(): array
    {
        $payload = [];

        foreach ($this->fillable as $fieldCamel) {
            $getter = 'get' . ucfirst($fieldCamel);

            if (!method_exists($this, $getter)) {
                continue;
            }

            $value = $this->{$getter}();

            // ignora null para permitir update parcial
            if ($value === null) {
                continue;
            }

            $payload[$this->camelToSnake($fieldCamel)] = $value;
        }

        return $payload;
    }

    protected function camelToSnake(string $field): string
    {
        return strtolower((string)preg_replace('/[A-Z]/', '_$0', $field));
    }

    protected function snakeToCamel(string $field): string
    {
        $field = strtolower($field);
        $field = str_replace('_', ' ', $field);
        $field = ucwords($field);
        $field = str_replace(' ', '', $field);

        return lcfirst($field);
    }
}