# 📁 api/source/Core/

## Núcleo do Sistema — A Base do Framework

---

### 🎯 Para que serve esta pasta?

A pasta `Core/` contém as classes que formam o **núcleo** (coração) do sistema. São classes
fundamentais que fazem o projeto funcionar, mas que **não fazem parte diretamente** das regras
de negócio.

Pense nelas como o **motor** do carro: você não vê, mas sem elas nada anda.

---

### 📂 Arquivos desta pasta

```
Core/
├── Connect.php    ← Classe de conexão com o banco de dados (PDO)
└── Router.php     ← Classe de roteamento (direciona as URLs para os Controllers)
```

---

## 🔌 Connect.php — Conexão com o Banco de Dados

### O que faz?
Cria e gerencia a **conexão PDO** com o banco de dados MySQL.

### O que é PDO?
**PDO** (PHP Data Objects) é uma extensão do PHP que fornece uma interface para acessar bancos
de dados de forma **segura** e **padronizada**.

### Exemplo:

```php
<?php

namespace source\Core;

use PDO;
use PDOException;

class Connect
{
    private static ?PDO $instance = null;

    /**
     * Retorna a conexão com o banco de dados.
     * Usa o padrão Singleton: cria apenas UMA conexão e reutiliza.
     */
    public static function getInstance(): ?PDO
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                    ]
                );
            } catch (PDOException $e) {
                echo json_encode(["error" => "Erro de conexão: " . $e->getMessage()]);
            }
        }
        return self::$instance;
    }
}
```

> 💡 **Padrão Singleton:** Garante que apenas UMA conexão com o banco exista durante toda a
> requisição, economizando recursos do servidor.

---

## 🗺️ Router.php — Sistema de Rotas

### O que faz?
Analisa a URL da requisição e **direciona** para o método correto do Controller.

### Como funciona?
1. O `.htaccess` redireciona tudo para `index.php`
2. O `index.php` chama o `Router`
3. O `Router` lê a URL (ex: `/api/usuarios`)
4. O `Router` encontra qual Controller e método deve ser chamado

### Exemplo:

```php
<?php

namespace source\Core;

class Router
{
    /**
     * Executa o roteamento baseado na URL recebida
     */
    public function execute(string $route, string $method): void
    {
        // Exemplo: rota /usuarios com método GET
        // Chama: Api::listarUsuarios()
    }
}
```

---

### 🔗 Quem usa as classes do Core?

| Classe        | Usada por                  | Para quê?                        |
|---------------|----------------------------|----------------------------------|
| `Connect.php` | **Models** (User, etc.)    | Acessar o banco de dados         |
| `Router.php`  | **index.php**              | Direcionar requisições às rotas  |

---

> 💡 **Dica:** O Core é a infraestrutura. Você raramente precisará modificar essas classes
> depois que estiverem prontas. O trabalho do dia a dia será nos Controllers e Models.

