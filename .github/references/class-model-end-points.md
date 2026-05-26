# Guia Didático — Classe `Core\Model.php` e Endpoints

Este arquivo explica, de forma simples, como usar a classe base `Model` para evitar repetir código de banco de dados nos models da aplicação.

## 1) Qual é a ideia da `Model`?

A classe `source/Core/Model.php` (no projeto atual com namespace `Source\Core`) é a **classe mãe** dos models.

Ela já oferece métodos prontos para operações comuns:

- `selectById(int $id)`
- `selectAll(array $filters = [], ?string $orderBy = 'id', string $direction = 'ASC')`
- `selectPaginator(int $page, int $perPage, array $filters = [], ?string $orderBy = 'id', string $direction = 'ASC')`
- `insert()`
- `updateById(int $id)`
- `deleteById(int $id)`
- `softDeleteById(int $id)`
- `getErrorMessage()`

Assim, cada model filho foca nos **atributos da entidade** e não na lógica repetitiva de SQL.

---

## 2) Como uma classe filha deve ser montada

Exemplo: `source/Models/Store/Product.php`.

A classe filha precisa:

1. `extends Model`
2. Declarar atributos privados (ex.: `id`, `categoryId`, `name`, `price`, `active`)
3. Implementar `getters` e `setters`
4. Definir no `__construct`:
   - `$this->table`
   - `$this->primaryKey`
   - `$this->fillable`

Exemplo usado no projeto:

```php
$this->table = 'products';
$this->primaryKey = 'id';
$this->fillable = ['categoryId', 'name', 'price', 'active'];
```

> `fillable` usa nomes em `camelCase` (lado PHP). A `Model` converte para `snake_case` no SQL.

---

## 3) Como o mapeamento de campos funciona

No banco: `category_id`  
No model: `categoryId`

A classe base faz essa conversão automaticamente:

- `camelToSnake()` para gravar no banco
- `snakeToCamel()` para hidratar o objeto ao buscar por ID

Isso permite chamar:

```php
$product = new Product();
$product->selectById(4);
echo $product->getName();
```

---

## 4) Exemplos práticos de uso

### 4.1 Inserção

```php
$product = new Product(null, 2, 'iPhone', 10000.00, 1);

if (!$product->insert()) {
    echo $product->getErrorMessage();
}
```

### 4.2 Atualização

```php
$product = new Product(null, 2, 'iPhone 15', 8999.90, 1);

if (!$product->updateById(4)) {
    echo $product->getErrorMessage();
}
```

### 4.3 Busca por ID com hidratação

```php
$product = new Product();

if (!$product->selectById(4)) {
    echo $product->getErrorMessage();
} else {
    echo $product->getName();
}
```

### 4.4 Exclusão lógica (soft delete)

```php
$product = new Product();

if (!$product->softDeleteById(4)) {
    echo $product->getErrorMessage();
}
```

---

## 5) Relação com os endpoints (Controller)

No `source/Controller/Products.php`, o fluxo recomendado é:

1. Validar entrada (`id`, `name`, `price`, etc.)
2. Instanciar model
3. Chamar método da `Model`
4. Se falhar, responder com `getErrorMessage()`
5. Se sucesso, montar JSON no padrão da API

Exemplo de padrão:

- Erro de validação: `400 bad_request`
- Não encontrado: `404 not_found`
- Erro interno no model: `500 internal_server_error`
- Sucesso: `200 success` ou `201 created`

---

## 6) Filtros e paginação

A `selectPaginator()` permite paginação por `page` e `perPage`.

Exemplo:

```php
$product = new Product();
$result = $product->selectPaginator(1, 10, ['active = 1'], 'id', 'ASC');
```

Retorno esperado:

- `page`
- `perPage`
- `total`
- `data`

---

## 7) Boas práticas para os exercícios

- Sempre validar os dados no controller antes de chamar o model.
- Evitar `echo` de debug dentro da `Model`.
- Usar `softDeleteById()` quando o exercício pedir exclusão lógica.
- Manter o model responsável por SQL e o controller responsável por HTTP/JSON.
- Ao adicionar novos campos no banco, atualizar `fillable`, getters e setters.

---

## 8) Checklist rápido para criar um novo model

- [ ] Criou a classe em `source/Models/...` estendendo `Model`
- [ ] Definiu `table`, `primaryKey` e `fillable`
- [ ] Implementou getters e setters dos atributos
- [ ] Testou `insert()` e `updateById()`
- [ ] Testou `selectById()` com hidratação
- [ ] Testou `softDeleteById()` (quando existir coluna `active`)
- [ ] Tratou erros com `getErrorMessage()` no controller

