# 📁 api/source/Support/

## Helpers — Funções Auxiliares

---

### 🎯 Para que serve esta pasta?

A pasta `Support/` contém **funções auxiliares** (helpers) que podem ser usadas em **qualquer
parte** do projeto. São funções utilitárias que facilitam tarefas repetitivas do dia a dia.

---

### 📂 Arquivo principal

```
Support/
└── Helpers.php    ← Funções auxiliares globais
```

---

### 💡 Exemplo de uso

```php
<?php

/**
 * Retorna uma resposta JSON padronizada
 *
 * @param int    $code    Código HTTP (200, 201, 400, 404, 500...)
 * @param string $status  "success" ou "error"
 * @param string $message Mensagem descritiva
 * @param mixed  $data    Dados a serem retornados (opcional)
 */
function response(int $code, string $status, string $message, mixed $data = null): void
{
    http_response_code($code);
    header("Content-Type: application/json");

    echo json_encode([
        "status"  => $status,
        "message" => $message,
        "data"    => $data
    ]);
}

/**
 * Sanitiza (limpa) uma string removendo tags HTML e espaços extras
 *
 * @param string $value Valor a ser sanitizado
 * @return string Valor limpo
 */
function sanitize(string $value): string
{
    return htmlspecialchars(strip_tags(trim($value)));
}

/**
 * Verifica se o método HTTP da requisição é o esperado
 *
 * @param string $method Método esperado (GET, POST, PUT, DELETE)
 * @return bool
 */
function isMethod(string $method): bool
{
    return $_SERVER["REQUEST_METHOD"] === strtoupper($method);
}
```

---

### 🧰 Exemplos de helpers comuns em projetos web

| Função          | O que faz                                        |
|-----------------|--------------------------------------------------|
| `response()`    | Retorna uma resposta JSON padronizada            |
| `sanitize()`    | Limpa dados de entrada contra XSS                |
| `isMethod()`    | Verifica o método HTTP da requisição             |
| `redirect()`    | Redireciona o usuário para outra URL             |
| `isEmail()`     | Valida se um texto é um e-mail válido            |
| `generateSlug()`| Converte "Olá Mundo" em "ola-mundo"              |

---

### 🔗 Quem usa os Helpers?

- **Controllers** — para formatar respostas e validar dados
- **Models** — para sanitizar dados antes de salvar no banco
- **Qualquer classe** do projeto que precise de uma função utilitária

---

> 💡 **Dica:** Helpers são funções **genéricas e reutilizáveis**. Se você perceber que está
> repetindo o mesmo código em vários lugares, considere criar um helper!

