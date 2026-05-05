# 📁 views/assets/

## Assets — Recursos Estáticos do Front-End

---

### 🎯 Para que serve esta pasta?

A pasta `assets/` organiza todos os **recursos estáticos** (arquivos que não mudam dinamicamente)
utilizados pelas interfaces do sistema. Isso inclui:

- 🎨 **Estilos** (arquivos CSS)
- ⚡ **Scripts** (arquivos JavaScript)
- 🖼️ **Imagens** (logos, ícones, fotos, banners)

---

### 📂 Estrutura desta pasta

```
assets/
├── _common/           ← Recursos COMPARTILHADOS entre todas as áreas
│   ├── images/
│   ├── scripts/
│   └── styles/
│
├── admin/             ← Recursos exclusivos da área ADMINISTRATIVA
│   ├── images/
│   ├── scripts/
│   └── styles/
│
├── app/               ← Recursos exclusivos da área do USUÁRIO LOGADO
│   ├── images/
│   ├── scripts/
│   └── styles/
│
└── public/            ← Recursos exclusivos da área PÚBLICA
    ├── images/
    ├── scripts/
    └── styles/
```

---

### 📖 O que vai em cada subpasta?

| Subpasta    | Conteúdo                                                  |
|-------------|-----------------------------------------------------------|
| `images/`   | Logotipos, ícones, banners, fotos de fundo                |
| `scripts/`  | Arquivos `.js` — lógica de interação, consumo de API      |
| `styles/`   | Arquivos `.css` — cores, fontes, layouts, responsividade   |

---

### 🧩 Por que separar por área?

Separar os assets por área traz várias vantagens:

1. **Organização** — Fácil encontrar o arquivo certo
2. **Desempenho** — Cada página carrega apenas os assets que precisa
3. **Manutenção** — Alterar o CSS do admin não afeta o public
4. **Trabalho em equipe** — Cada membro pode trabalhar em uma área sem conflitos

---

### 🤝 A pasta `_common/`

A pasta `_common/` (com underline na frente) guarda recursos que são **compartilhados** entre
todas as áreas. Exemplos:

- CSS de reset ou normalização
- Logotipo do sistema
- Scripts utilitários globais
- Fontes customizadas

> 💡 O underline `_` no início do nome faz a pasta aparecer **primeiro** na listagem,
> facilitando a identificação visual.

---

### 💡 Exemplo: Como referenciar no HTML

```html
<!-- CSS compartilhado (comum a todas as áreas) -->
<link rel="stylesheet" href="views/assets/_common/styles/reset.css">

<!-- CSS específico da área pública -->
<link rel="stylesheet" href="views/assets/public/styles/home.css">

<!-- JavaScript da área pública -->
<script src="views/assets/public/scripts/home.js"></script>
```

---

> 📚 Acesse cada subpasta (`_common/`, `admin/`, `app/`, `public/`) para mais detalhes.

