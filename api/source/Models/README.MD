# 📁 api/source/Models/

## Models — O "M" do MVC

---

### 🎯 Para que serve esta pasta?

A pasta `Models/` contém os **Models** do projeto. No padrão MVC, o Model é a camada
responsável por **representar os dados** e **se comunicar com o banco de dados**.

Cada Model geralmente corresponde a uma **tabela** do banco de dados.

---

### 🧠 Responsabilidades do Model

1. **Representar** uma entidade do banco de dados (ex: Usuário, Produto)
2. **Consultar** dados (SELECT)
3. **Inserir** dados (INSERT)
4. **Atualizar** dados (UPDATE)
5. **Excluir** dados (DELETE)

> 🚫 O Model **NÃO** deve conter lógica de apresentação (HTML) nem lógica de roteamento.
> Ele cuida **apenas dos dados**.

---

### 📂 Arquivo principal

```
Models/
└── User.php    ← Model que representa a tabela de usuários
```

---

### 💡 Exemplo de uso

```php
<?php

namespace source\Models;

use source\Core\Connect;
use PDO;

class User
{
    private ?PDO $db;

    public function __construct()
    {
        // Obtém a conexão com o banco de dados
        $this->db = Connect::getInstance();
    }

    /**
     * Busca todos os usuários
     * SQL: SELECT * FROM users
     */
    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }

    /**
     * Busca um usuário pelo ID
     * SQL: SELECT * FROM users WHERE id = ?
     */
    public function findById(int $id): ?object
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch() ?: null;
    }

    /**
     * Cadastra um novo usuário
     * SQL: INSERT INTO users (name, email) VALUES (?, ?)
     */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email) VALUES (:name, :email)"
        );
        $stmt->bindParam(":name", $data["name"]);
        $stmt->bindParam(":email", $data["email"]);
        return $stmt->execute();
    }
}
```

---

### 🔐 Boa prática: Prepared Statements

Sempre use **Prepared Statements** (consultas preparadas) para evitar **SQL Injection**:

```php
// ❌ ERRADO — vulnerável a SQL Injection
$db->query("SELECT * FROM users WHERE id = $id");

// ✅ CORRETO — seguro com Prepared Statement
$stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
```

---

### 🔗 Relação com as outras camadas

| O Model...                           | Exemplo                              |
|--------------------------------------|--------------------------------------|
| É chamado pelo **Controller**        | `$userModel->findAll()`              |
| Usa o **Connect** para acessar o BD  | `Connect::getInstance()`            |
| **Retorna dados** ao Controller      | Array de usuários, objeto, booleano  |

```
[Controller] → chama → [Model] → consulta → [Banco de Dados]
                           ↑                        ↓
                    Retorna dados  ←  Resultado da query
```

---

> 💡 **Dica:** Para cada nova tabela no banco, crie um novo Model.
> Exemplo: `Product.php`, `Order.php`, `Category.php`, etc.

