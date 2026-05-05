# 📁 views/assets/_common/

## Recursos Compartilhados — Comum a Todas as Áreas

---

### 🎯 Para que serve esta pasta?

A pasta `_common/` armazena os recursos que são **compartilhados entre todas as áreas** do
sistema (public, app e admin). Em vez de duplicar o mesmo arquivo em várias pastas, colocamos
aqui uma única vez e reutilizamos.

---

### 📦 O que colocar aqui?

| Tipo de recurso          | Exemplo                                       |
|--------------------------|-----------------------------------------------|
| **CSS Reset/Normalize**  | `reset.css`, `normalize.css`                   |
| **CSS Global**           | `global.css` (cores, fontes, variáveis)        |
| **Logotipo**             | `logo.png`, `logo.svg`                         |
| **Ícones**               | `favicon.ico`, ícones SVG                      |
| **Fontes**               | Arquivos `.woff`, `.woff2`                     |
| **Scripts utilitários**  | `utils.js`, `api.js` (funções de fetch)        |

---

### 💡 Exemplo prático

Imagine um arquivo `api.js` com funções reutilizáveis para consumir a API:

```javascript
// _common/scripts/api.js

const API_URL = "api";

/**
 * Função genérica para fazer requisições à API
 */
async function apiRequest(endpoint, method = "GET", body = null) {
    const options = {
        method: method,
        headers: { "Content-Type": "application/json" }
    };

    if (body) {
        options.body = JSON.stringify(body);
    }

    const response = await fetch(`${API_URL}/${endpoint}`, options);
    return await response.json();
}
```

Esse script pode ser usado em **qualquer** página do sistema (public, app ou admin).

---

> 💡 O prefixo `_` (underline) faz esta pasta aparecer **primeiro** na listagem de arquivos,
> indicando visualmente que ela é "especial" e compartilhada.

