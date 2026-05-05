# 📁 api/source/Config/

## Configurações do Sistema

---

### 🎯 Para que serve esta pasta?

A pasta `Config/` armazena os arquivos de **configuração** do projeto. Aqui ficam definidas
informações como:

- 🔌 Dados de conexão com o banco de dados (host, usuário, senha, nome do banco)
- 🌐 URL base do projeto
- 🔑 Chaves e constantes do sistema
- ⚙️ Qualquer configuração global que o sistema precise

---

### 📂 Arquivo principal

```
Config/
└── Config.php    ← Arquivo central de configurações
```

---

### 💡 Exemplo de uso

O arquivo `Config.php` geralmente define **constantes** que serão usadas em todo o projeto:

```php
<?php

// Configurações do Banco de Dados
define("DB_HOST", "localhost");
define("DB_NAME", "acme_db");
define("DB_USER", "root");
define("DB_PASS", "");

// URL base do projeto
define("BASE_URL", "http://localhost/acme-3am-g1");
define("API_URL", BASE_URL . "/api");
```

---

### 🔐 Boa prática: Segurança

> ⚠️ **NUNCA** envie arquivos de configuração com senhas reais para o GitHub!
>
> Adicione o `Config.php` ao `.gitignore` e crie um arquivo `Config.example.php`
> com valores fictícios para servir de modelo.

---

### 🔗 Quem usa esta pasta?

- **`Core/Connect.php`** — usa as constantes de banco de dados para criar a conexão PDO.
- **`Core/Router.php`** — pode usar a URL base para montar as rotas.
- **Qualquer classe** que precise de uma configuração global.

