<?php

namespace Source\Models;

use source\Core\Connect;
use Source\Core\Model;

class Address extends Model
{
    private ?int $id = null;
    private ?int $userId = null;
    private ?string $street = null;
    private ?string $number = null;
    private ?int $active = null;

    public function __construct(?int $id = null, ?int $userId = null,
                                ?string $street = null, ?string $number = null,
                                ?int $active = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->street = $street;
        $this->number = $number;
        $this->active = $active;

        $this->table = 'addresses'; // nome da tabela do banco
        $this->primaryKey = 'id'; // nome da chave primária da tabela
        $this->fillable = ['userId', 'street', 'number', 'active']; // camelCase
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }

    public function setActive(?int $active): void
    {
        $this->active = $active;
    }

    public function selectByUserId(int $userId): array
    {
        $query = "SELECT * FROM addresses WHERE user_id = :user_id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}