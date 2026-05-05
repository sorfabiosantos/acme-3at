# 📁 views/assets/admin/

## Recursos do Painel Administrativo

---

### 🎯 Para que serve esta pasta?

A pasta `admin/` contém os recursos visuais (CSS, JS, imagens) **exclusivos da área
administrativa** do sistema. Apenas o **administrador** acessa essa área.

---

### 🔒 O que é a área administrativa?

É o painel de controle do sistema, onde o administrador pode:

- 👥 Gerenciar usuários (listar, editar, excluir)
- 📊 Visualizar relatórios e estatísticas
- ⚙️ Configurar parâmetros do sistema
- 📋 Gerenciar conteúdos, produtos, categorias, etc.

---

### 📂 Estrutura desta pasta

```
admin/
├── images/     ← Imagens exclusivas do painel admin (ícones, banners)
├── scripts/    ← JavaScript do admin (gerenciamento de dados, tabelas)
└── styles/     ← CSS do admin (layout do painel, dashboard, formulários)
```

---

### 💡 Exemplos de arquivos

| Pasta      | Arquivo exemplo        | Descrição                              |
|------------|------------------------|----------------------------------------|
| `styles/`  | `dashboard.css`        | Layout do painel principal             |
| `styles/`  | `tables.css`           | Estilo das tabelas de listagem         |
| `scripts/` | `users.js`             | CRUD de usuários via API               |
| `scripts/` | `dashboard.js`         | Gráficos e estatísticas                |
| `images/`  | `admin-logo.png`       | Logo do painel administrativo          |

---

### 💡 Exemplo: Script de gerenciamento de usuários

```javascript
// admin/scripts/users.js

// Lista todos os usuários no painel admin
async function listarUsuarios() {
    const response = await fetch("api/usuarios");
    const result = await response.json();

    const tabela = document.getElementById("tabela-usuarios");
    tabela.innerHTML = "";

    result.data.forEach(user => {
        tabela.innerHTML += `
            <tr>
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>
                    <button onclick="editarUsuario(${user.id})">Editar</button>
                    <button onclick="excluirUsuario(${user.id})">Excluir</button>
                </td>
            </tr>
        `;
    });
}
```

---

> 💡 **Dica:** Os recursos do admin são **independentes** dos recursos do public e do app.
> Alterar o CSS aqui não afeta as outras áreas.

