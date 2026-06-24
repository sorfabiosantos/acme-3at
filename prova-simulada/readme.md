# Prova P2 — Simulada

## Padrão de Retorno da API

Todos os endpoints deste sistema devem seguir o padrão de resposta JSON abaixo:

| Código | `type`    | `status`               | Significado                                                    |
|--------|-----------|------------------------|----------------------------------------------------------------|
| 200    | `success` | `success`              | Requisição bem-sucedida, com ou sem dados de retorno.          |
| 201    | `success` | `created`              | Recurso criado com sucesso (usado em POST).                    |
| 400    | `error`   | `bad_request`          | Dados enviados pelo cliente são inválidos ou incompletos.      |
| 401    | `error`   | `unauthorized`         | Usuário não está autenticado (sem token ou token inválido).    |
| 403    | `error`   | `forbidden`            | Usuário autenticado, mas sem permissão para este recurso.      |
| 404    | `error`   | `not_found`            | O recurso solicitado não existe.                               |
| 500    | `error`   | `internal_server_error`| Erro inesperado no servidor.                                   |

---

## Questão 1 — Editoras e Livros (6,0 pontos)

Uma biblioteca precisa cadastrar as **editoras** dos livros e os **livros** do seu acervo. Você deverá criar os Models, Controllers e rotas para realizar o CRUD completo dessas duas entidades.

---

### 1.1 — Editora (Publisher)

Crie a Model `Source\Models\Publisher` estendendo `Source\Core\Model` e o Controller `Source\Controller\Publishers` estendendo `Source\Controller\Api`.

A tabela é `publishers` com os campos: `id` (PK, AUTO_INCREMENT), `name` (varchar), `active` (tinyint, default 1).

#### 1.1a — Listar todas as editoras (0,5 ponto)

```
GET /publishers/list
```

**✅ 200 OK**
```json
{
  "code": 200,
  "type": "success",
  "status": "success",
  "message": "Lista de Editoras",
  "data": [
    { "id": 1, "name": "Editora Abril", "active": 1 },
    { "id": 2, "name": "Companhia das Letras", "active": 1 }
  ]
}
```

#### 1.1b — Buscar editora por ID (0,5 ponto)

```
GET /publishers/list/{publisherId}
```

**✅ 200 OK**
```json
{
  "code": 200,
  "type": "success",
  "status": "success",
  "message": "Editora encontrada",
  "data": { "id": 1, "name": "Editora Abril", "active": 1 }
}
```

**⚠️ 400 Bad Request** — `{publisherId}` não é inteiro válido
**❌ 404 Not Found** — Editora não existe

#### 1.1c — Inserir editora (0,6 ponto)

```
POST /publishers
```
Dados do Formulário: `name=Nova Editora`

Requer autenticação **admin** (token JWT, `typeId = 1`).

**✅ 201 Created**
```json
{
  "code": 201,
  "type": "success",
  "status": "created",
  "message": "Editora criada com sucesso",
  "data": { "id": 4, "name": "Nova Editora", "active": 1 }
}
```

**⚠️ 400 Bad Request** — Campo `name` ausente ou vazio
**⛔ 401 Unauthorized** — Token ausente ou inválido
**❌ 500 Internal Server Error** — Falha ao inserir

#### 1.1d — Atualizar editora (0,7 ponto)

```
PUT /publishers/{publisherId}
```
Dados do Formulário: `name=Editora Atualizada`

Requer autenticação **admin**.

**✅ 200 OK** — Editora atualizada, retorna o registro atualizado
**⚠️ 400 Bad Request** — ID inválido ou `name` ausente
**⛔ 401 Unauthorized** — Token ausente ou inválido
**❌ 404 Not Found** — Editora não existe

#### 1.1e — Remover editora — soft delete (0,7 ponto)

```
DELETE /publishers/{publisherId}
```

Requer autenticação **admin**. Execute soft delete: `UPDATE publishers SET active = 0 WHERE id = :id AND active = 1`.

**✅ 200 OK** — Editora removida com sucesso
**⚠️ 400 Bad Request** — ID inválido
**⛔ 401 Unauthorized** — Token ausente ou inválido
**❌ 404 Not Found** — Editora não encontrada ou já inativa

> 💡 Se `rowCount()` retornar 0, o registro não existe ou já está inativo — retorne 404.

---

### 1.2 — Livro (Book)

Crie a Model `Source\Models\Book` estendendo `Source\Core\Model` e o Controller `Source\Controller\Books` estendendo `Source\Controller\Api`.

A tabela é `books` com os campos: `id` (PK, AUTO_INCREMENT), `publisher_id` (FK → `publishers.id`), `title` (varchar), `active` (tinyint, default 1).

> **Atenção:** Nos endpoints de listagem e busca por ID, utilize `JOIN` com `publishers` para retornar `publisher_name` no lugar de `publisher_id`.

#### 1.2a — Listar todos os livros (0,5 ponto)

```
GET /books/list
```

**✅ 200 OK**
```json
{
  "code": 200,
  "type": "success",
  "status": "success",
  "message": "Lista de Livros",
  "data": [
    {
      "id": 1,
      "title": "Dom Casmurro",
      "publisher_name": "Companhia das Letras",
      "active": 1
    }
  ]
}
```

#### 1.2b — Buscar livro por ID (0,5 ponto)

```
GET /books/list/{bookId}
```

**✅ 200 OK** — Retorna o livro com `publisher_name` via JOIN
**⚠️ 400 Bad Request** — `{bookId}` não é inteiro válido
**❌ 404 Not Found** — Livro não existe

#### 1.2c — Inserir livro (0,6 ponto)

```
POST /books
```
Dados do Formulário: `publisher_id=1&title=Novo Livro`

Requer autenticação **admin**.

**✅ 201 Created** — Livro criado, retorna com `publisher_name`
**⚠️ 400 Bad Request** — Campos `publisher_id` ou `title` ausentes/vazios, ou `publisher_id` não é inteiro
**⛔ 401 Unauthorized** — Token ausente ou inválido
**❌ 500 Internal Server Error** — Falha ao inserir

> 💡 Valide com `filter_var($data["publisher_id"], FILTER_VALIDATE_INT)`.

#### 1.2d — Atualizar livro (0,7 ponto)

```
PUT /books/{bookId}
```
Dados do Formulário: `publisher_id=2&title=Livro Atualizado`

Requer autenticação **admin**.

**✅ 200 OK** — Livro atualizado, retorna com `publisher_name`
**⚠️ 400 Bad Request** — ID inválido ou campos obrigatórios ausentes
**⛔ 401 Unauthorized** — Token ausente ou inválido
**❌ 404 Not Found** — Livro não existe

#### 1.2e — Remover livro — soft delete (0,7 ponto)

```
DELETE /books/{bookId}
```

Requer autenticação **admin**. Soft delete via `UPDATE books SET active = 0 WHERE id = :id AND active = 1`.

**✅ 200 OK** — Livro removido com sucesso
**⚠️ 400 Bad Request** — ID inválido
**⛔ 401 Unauthorized** — Token ausente ou inválido
**❌ 404 Not Found** — Livro não encontrado ou já inativo

---

### Pontuação — Questão 1

| Subquestão | Endpoint | Pontos |
|-----------|----------|--------|
| 1.1a | `GET /publishers/list` | 0,5 |
| 1.1b | `GET /publishers/list/{id}` | 0,5 |
| 1.1c | `POST /publishers` | 0,6 |
| 1.1d | `PUT /publishers/{id}` | 0,7 |
| 1.1e | `DELETE /publishers/{id}` | 0,7 |
| 1.2a | `GET /books/list` | 0,5 |
| 1.2b | `GET /books/list/{id}` | 0,5 |
| 1.2c | `POST /books` | 0,6 |
| 1.2d | `PUT /books/{id}` | 0,7 |
| 1.2e | `DELETE /books/{id}` | 0,7 |
| **Total** | | **6,0** |

---

## Questão 2 — Empréstimos (4,0 pontos)

Além do acervo, a biblioteca precisa registrar os **empréstimos** (loans) de livros. Cada empréstimo vincula um **usuário** (aluno) a um **livro**, com um nome descritivo.

---

### 2.1 — Empréstimo (Loan)

Crie a Model `Source\Models\Loan` estendendo `Source\Core\Model` e o Controller `Source\Controller\Loans` estendendo `Source\Controller\Api`.

A tabela é `loans` com os campos: `id` (PK, AUTO_INCREMENT), `user_id` (FK → `users.id`), `book_id` (FK → `books.id`), `name` (varchar), `active` (tinyint, default 1).

> **Atenção:** Nos endpoints de listagem e busca por ID, utilize JOIN duplo — com `users` para obter `user_name` e com `books` para obter `book_title`.

#### 2.1a — Listar todos os empréstimos (0,7 ponto)

```
GET /loans/list
```

**✅ 200 OK**
```json
{
  "code": 200,
  "type": "success",
  "status": "success",
  "message": "Lista de Empréstimos",
  "data": [
    {
      "id": 1,
      "name": "Empréstimo de João Silva",
      "user_name": "João Silva",
      "book_title": "Dom Casmurro",
      "active": 1
    }
  ]
}
```

> 💡 Query de exemplo: `SELECT l.*, u.name AS user_name, b.title AS book_title FROM loans l JOIN users u ON l.user_id = u.id JOIN books b ON l.book_id = b.id`

#### 2.1b — Buscar empréstimo por ID (0,7 ponto)

```
GET /loans/list/{loanId}
```

**✅ 200 OK** — Retorna o empréstimo com `user_name` e `book_title` via JOIN
**⚠️ 400 Bad Request** — `{loanId}` não é inteiro válido
**❌ 404 Not Found** — Empréstimo não existe

#### 2.1c — Inserir empréstimo (0,8 ponto)

```
POST /loans
```
Dados do Formulário: `user_id=11&book_id=1&name=Empréstimo de Maria Souza`

Requer autenticação **standard** ou **student** (token JWT, `typeId = 2` ou `typeId = 3`).

**✅ 201 Created** — Empréstimo criado, retorna com `user_name` e `book_title`
**⚠️ 400 Bad Request** — Campos `user_id`, `book_id` ou `name` ausentes/vazios, ou IDs não são inteiros
**⛔ 401 Unauthorized** — Token ausente ou inválido
**❌ 500 Internal Server Error** — Falha ao inserir

> 💡 O `user_id` do formulário deve coincidir com o `id` do usuário autenticado (disponível em `$this->userAuthId`). Valide essa correspondência.

#### 2.1d — Atualizar empréstimo (0,9 ponto)

```
PUT /loans/{loanId}
```
Dados do Formulário: `name=Empréstimo Atualizado`

Requer autenticação. O usuário autenticado só pode alterar seus próprios empréstimos (verifique se `user_id` do empréstimo = `$this->userAuthId`).

**✅ 200 OK** — Empréstimo atualizado
**⚠️ 400 Bad Request** — ID inválido ou `name` ausente
**⛔ 401 Unauthorized** — Token ausente ou inválido
**⛔ 403 Forbidden** — Empréstimo pertence a outro usuário
**❌ 404 Not Found** — Empréstimo não existe

#### 2.1e — Remover empréstimo — soft delete (0,9 ponto)

```
DELETE /loans/{loanId}
```

Requer autenticação. O usuário autenticado só pode remover seus próprios empréstimos. Soft delete: `UPDATE loans SET active = 0 WHERE id = :id AND active = 1`.

**✅ 200 OK** — Empréstimo removido com sucesso
**⚠️ 400 Bad Request** — ID inválido
**⛔ 401 Unauthorized** — Token ausente ou inválido
**⛔ 403 Forbidden** — Empréstimo pertence a outro usuário
**❌ 404 Not Found** — Empréstimo não encontrado ou já inativo

---

### Pontuação — Questão 2

| Subquestão | Endpoint | Pontos |
|-----------|----------|--------|
| 2.1a | `GET /loans/list` | 0,7 |
| 2.1b | `GET /loans/list/{id}` | 0,7 |
| 2.1c | `POST /loans` | 0,8 |
| 2.1d | `PUT /loans/{id}` | 0,9 |
| 2.1e | `DELETE /loans/{id}` | 0,9 |
| **Total** | | **4,0** |

---

## Resumo Geral

| Questão | Conteúdo | Pontos |
|---------|----------|--------|
| 1 | Publisher + Book (Models, Controllers, Rotas) | 6,0 |
| 2 | Loan (Model, Controller, Rotas) | 4,0 |
| **Total** | | **10,0** |

## O que entregar

Ao final da prova, os seguintes arquivos devem ter sido criados ou modificados:

```
api/source/Models/
├── Publisher.php
├── Book.php
└── Loan.php

api/source/Controller/
├── Publishers.php
├── Books.php
└── Loans.php

api/index.php   (editado — novas rotas)
```
