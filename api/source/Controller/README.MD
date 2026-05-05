# 📁 api/source/Controller/

## Controllers — O "C" do MVC

---

### 🎯 Para que serve esta pasta?

A pasta `Controller/` contém os **Controllers** do projeto. No padrão MVC, o Controller é a
camada que **recebe as requisições**, **processa a lógica** e **retorna as respostas**.

O Controller é o **intermediário** entre o front-end (View) e o banco de dados (Model).

---

### 🧠 Responsabilidades do Controller

1. **Receber** a requisição HTTP (GET, POST, PUT, DELETE)
2. **Validar** os dados recebidos
3. **Chamar** o Model para acessar o banco de dados
4. **Formatar** e **retornar** a resposta (geralmente em JSON)

> 🚫 O Controller **NÃO** deve acessar o banco de dados diretamente.
> Ele sempre pede ao **Model** para fazer isso.

---

### 📂 Arquivo principal

```
Controller/
└── Api.php    ← Controller principal da API
```

---

### 💡 Exemplo de uso

```php
<?php

namespace source\Controller;

use source\Models\User;

class Api
{
    /**
     * Lista todos os usuários
     * Método HTTP: GET
     * Rota: /api/usuarios
     */
    public function listarUsuarios(): void
    {
        $userModel = new User();
        $usuarios = $userModel->findAll();

        echo json_encode([
            "status" => "success",
            "data" => $usuarios
        ]);
    }

    /**
     * Cadastra um novo usuário
     * Método HTTP: POST
     * Rota: /api/usuarios
     */
    public function cadastrarUsuario(array $dados): void
    {
        $userModel = new User();
        $resultado = $userModel->create($dados);

        echo json_encode([
            "status" => "success",
            "message" => "Usuário cadastrado com sucesso!"
        ]);
    }
}
```

---

### 🔗 Relação com as outras camadas

```
[Router] → chama o → [Controller] → usa o → [Model]
                           ↓
                     Resposta JSON
                           ↓
                      [Front-end]
```

| O Controller...            | Exemplo                              |
|----------------------------|--------------------------------------|
| Recebe dados do **Router** | A rota `/api/usuarios` foi acessada  |
| Chama o **Model**          | `$userModel->findAll()`              |
| Retorna **JSON**           | `echo json_encode($dados)`           |

---

> 💡 **Dica:** À medida que o projeto crescer, você pode criar outros Controllers.
> Por exemplo: `ProductController.php`, `AuthController.php`, etc.

