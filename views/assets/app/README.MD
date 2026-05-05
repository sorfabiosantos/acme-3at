# 📁 views/assets/app/

## Recursos da Área do Usuário Logado

---

### 🎯 Para que serve esta pasta?

A pasta `app/` contém os recursos visuais (CSS, JS, imagens) **exclusivos da área do usuário
autenticado** (logado). Essa é a área principal da aplicação, onde o usuário interage com o
sistema após fazer login.

---

### 👤 O que é a área do usuário logado (app)?

É a área onde o usuário comum (não administrador) acessa funcionalidades como:

- 🏠 Dashboard pessoal
- 👤 Editar seu perfil
- 📝 Criar e gerenciar seus conteúdos
- ⚙️ Configurações da conta
- 🔔 Notificações

---

### 📂 Estrutura desta pasta

```
app/
├── images/     ← Imagens da área logada (ícones, avatares padrão)
├── scripts/    ← JavaScript da área logada (perfil, dashboard)
└── styles/     ← CSS da área logada (layout do painel do usuário)
```

---

### 💡 Exemplos de arquivos

| Pasta      | Arquivo exemplo        | Descrição                              |
|------------|------------------------|----------------------------------------|
| `styles/`  | `profile.css`          | Estilo da página de perfil             |
| `styles/`  | `dashboard.css`        | Layout do dashboard do usuário         |
| `scripts/` | `profile.js`           | Edição de perfil via API               |
| `scripts/` | `auth.js`              | Verificação de autenticação            |
| `images/`  | `default-avatar.png`   | Avatar padrão para novos usuários      |

---

### 💡 Exemplo: Script de perfil do usuário

```javascript
// app/scripts/profile.js

// Carrega os dados do perfil do usuário logado
async function carregarPerfil() {
    const response = await fetch("api/perfil", {
        headers: {
            "Authorization": "Bearer " + localStorage.getItem("token")
        }
    });
    const result = await response.json();

    document.getElementById("nome").value = result.data.name;
    document.getElementById("email").value = result.data.email;
}

// Atualiza os dados do perfil
async function atualizarPerfil(event) {
    event.preventDefault();

    const dados = {
        name: document.getElementById("nome").value,
        email: document.getElementById("email").value
    };

    const response = await fetch("api/perfil", {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(dados)
    });

    const result = await response.json();
    alert(result.message);
}
```

---

### 🔄 Diferença entre `app/` e `admin/`

| Aspecto       | `app/` (Usuário)              | `admin/` (Administrador)          |
|---------------|-------------------------------|-----------------------------------|
| Quem acessa?  | Usuário comum logado          | Administrador do sistema          |
| Permissões    | Acessa **seus próprios** dados| Acessa **todos** os dados         |
| Funcionalidades| Perfil, dashboard pessoal    | Gerenciar usuários, relatórios    |

---

> 💡 **Dica:** Separar `app/` de `admin/` permite criar experiências visuais diferentes
> para cada tipo de usuário.

