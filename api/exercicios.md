# Exercícios — Web Services

## Padrão de Retorno da API

Todos os endpoints deste sistema devem seguir o padrão de resposta JSON abaixo:

| Código | `status`               | Significado                                                    |
|--------|------------------------|----------------------------------------------------------------|
| 200    | `success`              | Requisição bem-sucedida, com ou sem dados de retorno.          |
| 201    | `created`              | Recurso criado com sucesso (usado em POST).                    |
| 400    | `bad_request`          | Dados enviados pelo cliente são inválidos ou incompletos.      |
| 401    | `unauthorized`         | Usuário não está autenticado (sem token ou token inválido).    |
| 403    | `forbidden`            | Usuário autenticado, mas sem permissão para este recurso.      |
| 404    | `not_found`            | O recurso solicitado não existe.                               |
| 500    | `internal_server_error`| Erro inesperado no servidor.                                   |

---

## Exercício 01 — Listando todos os produtos

### Contextualizando

Você está desenvolvendo a API de um sistema de gerenciamento de estoque. O frontend precisa exibir uma tabela com todos os produtos cadastrados, incluindo o nome da categoria de cada um. Como os dados vêm de tabelas diferentes (`products` e `products_categories`), o backend precisa fazer um `JOIN` e retornar tudo em um único endpoint.

### Objetivo

Criar um endpoint que retorne a lista completa de produtos com suas respectivas categorias.

### Enunciado

Implemente o endpoint `GET /products/list` no controller `Products` e no model `Product`.

O retorno deve seguir este padrão:

```json
{
  "code": 200,
  "type": "success",
  "status": "success",
  "message": "Lista de Produtos",
  "data": [
    {
      "id": 1,
      "name": "Mouse Logitech M170",
      "price": "89.90",
      "category_name": "Periféricos"
    },
    {
      "id": 2,
      "name": "Teclado Logitech K120",
      "price": "79.90",
      "category_name": "Periféricos"
    }
  ]
}
```

> 💡 **Dica:** Use `JOIN` entre `products` e `products_categories` para obter o `category_name` sem precisar de uma segunda consulta.

---

## Exercício 02 — Buscando um produto pelo ID

### Contextualizando

Com o endpoint de listagem funcionando, o próximo passo natural é permitir que o frontend busque os detalhes de **um produto específico** — por exemplo, ao clicar em um item da tabela.

### Objetivo

Criar um endpoint que receba um `id` via URL, valide o parâmetro, consulte o banco e retorne o produto encontrado — ou uma mensagem de erro adequada caso o `id` seja inválido ou o produto não exista.

### Enunciado

Implemente o endpoint `GET /products/list/{productId}`.

Trate os seguintes cenários:

**✅ Produto encontrado — `200 OK`**
```json
{
  "code": 200,
  "type": "success",
  "status": "success",
  "message": "Produto encontrado",
  "data": {
    "id": 1,
    "name": "Mouse Logitech M170",
    "price": "89.90",
    "category_name": "Periféricos"
  }
}
```

**⚠️ ID inválido (não é número inteiro) — `400 Bad Request`**
```json
{
  "code": 400,
  "type": "error",
  "status": "bad_request",
  "message": "ID do produto é obrigatório e deve ser um número inteiro",
  "data": null
}
```

**❌ Produto não existe no banco — `404 Not Found`**
```json
{
  "code": 404,
  "type": "error",
  "status": "not_found",
  "message": "Produto não encontrado",
  "data": null
}
```

> 💡 **Dica:** Valide o parâmetro `{productId}` antes de consultar o banco. Use `filter_var($id, FILTER_VALIDATE_INT)` para verificar se é um inteiro válido.

---

## Exercício 03 — Inserindo um novo produto

### Contextualizando

O painel administrativo precisa de uma tela para cadastrar novos produtos. O formulário envia `name`, `price` e `category_id` para a API, que valida os dados e insere o registro no banco. O frontend espera receber de volta o produto recém-criado para confirmar o sucesso ao usuário.

### Objetivo

Criar um endpoint que receba os dados de um produto via `POST`, valide os campos obrigatórios, insira o registro no banco e retorne o produto criado.

### Enunciado

Implemente o endpoint `POST /products`.

O corpo da requisição (`body`) será um JSON com:
```json
{
  "name": "Headset HyperX Cloud II",
  "price": 349.90,
  "category_id": 2
}
```

Trate os seguintes cenários:

**✅ Produto criado com sucesso — `201 Created`**
```json
{
  "code": 201,
  "type": "success",
  "status": "created",
  "message": "Produto criado com sucesso",
  "data": {
    "id": 26,
    "name": "Headset HyperX Cloud II",
    "price": "349.90",
    "category_name": "Periféricos"
  }
}
```

**⚠️ Campos obrigatórios ausentes ou inválidos — `400 Bad Request`**
```json
{
  "code": 400,
  "type": "error",
  "status": "bad_request",
  "message": "Os campos name, price e category_id são obrigatórios",
  "data": null
}
```

**❌ Erro inesperado ao salvar — `500 Internal Server Error`**
```json
{
  "code": 500,
  "type": "error",
  "status": "internal_server_error",
  "message": "Não foi possível cadastrar o produto",
  "data": null
}
```

> 💡 **Dica:** Leia o corpo da requisição com `file_get_contents("php://input")` e decodifique com `json_decode()`. Verifique se todos os campos obrigatórios estão presentes antes de chamar o model. O 500 deve ser retornado quando o `INSERT` falhar por motivo interno (ex: FK inválida, banco indisponível).

---

## Exercício 04 — Atualizando um produto

### Contextualizando

Na tela de edição do painel administrativo, o usuário altera os dados de um produto já existente e clica em "Salvar". O frontend envia os novos valores para a API, que valida o `id`, verifica se o produto existe e aplica as alterações no banco.

### Objetivo

Criar um endpoint que receba o `id` do produto via URL e os novos dados via `body`, valide tudo e execute o `UPDATE` — retornando o produto atualizado.

### Enunciado

Implemente o endpoint `PUT /products/{productId}`.

O corpo da requisição seguirá o mesmo formato do `POST`:
```json
{
  "name": "Headset HyperX Cloud II Wireless",
  "price": 499.90,
  "category_id": 2
}
```

Trate os seguintes cenários:

**✅ Produto atualizado com sucesso — `200 OK`**
```json
{
  "code": 200,
  "type": "success",
  "status": "success",
  "message": "Produto atualizado com sucesso",
  "data": {
    "id": 26,
    "name": "Headset HyperX Cloud II Wireless",
    "price": "499.90",
    "category_name": "Periféricos"
  }
}
```

**⚠️ ID inválido ou campos ausentes — `400 Bad Request`**
```json
{
  "code": 400,
  "type": "error",
  "status": "bad_request",
  "message": "ID inválido ou campos obrigatórios ausentes",
  "data": null
}
```

**❌ Produto não encontrado — `404 Not Found`**
```json
{
  "code": 404,
  "type": "error",
  "status": "not_found",
  "message": "Produto não encontrado",
  "data": null
}
```

> 💡 **Dica:** Antes de executar o `UPDATE`, faça um `SELECT` para confirmar que o produto existe — e use o mesmo retorno 404 do Exercício 02. Você pode reaproveitar o método de busca por ID que já implementou.

---

## Exercício 05 — Removendo um produto (soft delete)

### Contextualizando

No mundo real, **excluir registros definitivamente do banco é uma má prática**: perde-se histórico, pode-se quebrar integridade referencial e não há como recuperar o dado. A solução adotada neste sistema é o **soft delete** — em vez de deletar o registro, ele é marcado como inativo com um campo `active`.

### Objetivo

Criar um endpoint de exclusão que **não apague o registro**, mas altere seu campo `active` para `0`, tornando-o invisível nas listagens sem removê-lo do banco.

### Enunciado

**Passo 1 — Altere a tabela no banco** e atualize o `dump.slq`:
```sql
ALTER TABLE `products` ADD COLUMN `active` tinyint(1) NOT NULL DEFAULT 1;
```

**Passo 2 — Atualize as queries existentes:**
Os endpoints `GET /products/list` e `GET /products/list/{id}` devem passar a filtrar apenas produtos com `active = 1`.

**Passo 3 — Implemente o endpoint `DELETE /products/{productId}`:**

Trate os seguintes cenários:

**✅ Produto desativado com sucesso — `200 OK`**
```json
{
  "code": 200,
  "type": "success",
  "status": "success",
  "message": "Produto removido com sucesso",
  "data": null
}
```

**⚠️ ID inválido — `400 Bad Request`**
```json
{
  "code": 400,
  "type": "error",
  "status": "bad_request",
  "message": "ID do produto é obrigatório e deve ser um número inteiro",
  "data": null
}
```

**❌ Produto não encontrado ou já inativo — `404 Not Found`**
```json
{
  "code": 404,
  "type": "error",
  "status": "not_found",
  "message": "Produto não encontrado",
  "data": null
}
```

> 💡 **Dica:** A query do soft delete é um simples `UPDATE`: `UPDATE products SET active = 0 WHERE id = :id AND active = 1`. Se `rowCount()` retornar `0`, o produto não existe ou já estava inativo — retorne `404`.
