# 📁 views/

## Views — O "V" do MVC (Front-End)

---

### 🎯 Para que serve esta pasta?

A pasta `views/` contém tudo relacionado ao **front-end** do projeto — ou seja, tudo que o
**usuário vê e interage** no navegador. Aqui ficam as páginas HTML e os recursos visuais
(assets) como CSS, JavaScript e imagens.

---

### 📖 O que é uma View no MVC?

No padrão MVC, a **View** é a camada de **apresentação**. Ela é responsável por:

- 🖥️ Exibir a interface para o usuário
- 🎨 Aplicar estilos visuais (CSS)
- ⚡ Adicionar interatividade (JavaScript)
- 🔄 Consumir a API para buscar e enviar dados

> 🚫 A View **NÃO** deve conter regras de negócio ou acesso ao banco de dados.
> Ela apenas **exibe dados** que recebe da API.

---

### 📂 Estrutura desta pasta

```
views/
└── assets/         ← Recursos estáticos organizados por área do sistema
    ├── _common/    ← Recursos compartilhados entre todas as áreas
    ├── admin/      ← Área administrativa (painel do administrador)
    ├── app/        ← Área da aplicação (usuário logado)
    └── public/     ← Área pública (visitante, sem login)
```

---

### 🌐 As três áreas do sistema

O projeto é dividido em **três áreas** diferentes, cada uma com seus próprios recursos visuais:

| Área        | Quem acessa?                     | Exemplo de telas                     |
|-------------|----------------------------------|--------------------------------------|
| **public**  | Qualquer visitante (sem login)   | Home, Sobre, Contato, Login          |
| **app**     | Usuário autenticado (logado)     | Dashboard, Perfil, Configurações     |
| **admin**   | Administrador do sistema         | Gerenciar usuários, Relatórios       |

---

### 🔗 Como as Views se comunicam com a API?

As Views usam **JavaScript** (com `fetch` ou `XMLHttpRequest`) para consumir a API:

```javascript
// Exemplo: Buscando usuários da API
fetch("api/usuarios")
    .then(response => response.json())
    .then(data => {
        console.log(data);
        // Atualiza o HTML com os dados recebidos
    })
    .catch(error => {
        console.error("Erro:", error);
    });
```

---

> 📚 Acesse a pasta `assets/` para entender a organização dos recursos estáticos.

