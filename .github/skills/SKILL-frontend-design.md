# SKILL: Frontend Design

> Skill operacional — define **como** a IA deve gerar código de frontend neste projeto.  
> Para **o que** planejar, consulte `.github/agents/AGENT-frontdend-design.md`.

---

## Quando aplicar esta skill

Aplique sempre que precisar criar ou editar:
- Páginas HTML das áreas `public`, `app` ou `admin`
- Arquivos CSS de estilo
- Arquivos JavaScript de comportamento de interface
- Componentes ou layouts reutilizáveis em `_common`

---

## Passo a passo ao gerar uma tela

1. **Identifique a área** (`public`, `app` ou `admin`) e use a pasta correta em `views/assets/<area>/`.
2. **Leia o AGENT** (`.github/agents/AGENT-frontdend-design.md`) para entender contexto, componentes e navegação definidos pelo estudante.
3. **Crie o HTML** usando exclusivamente tags semânticas. Veja o padrão de estrutura abaixo.
4. **Separe o CSS** em arquivo `.css` próprio; nunca use `style` inline.
5. **Separe o JS** em arquivo `.js` próprio; nunca use eventos inline no HTML.
6. **Marque mocks estáticos** com comentários `<!-- TODO: substituir por dado real da API -->` para facilitar a integração futura.

---

## Estrutura HTML obrigatória

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>[Título da Tela] — [Nome do Sistema]</title>
  <link rel="stylesheet" href="../_common/styles/base.css">
  <link rel="stylesheet" href="styles/[nome-da-tela].css">
</head>
<body>
  <header>
    <nav>
      <!-- menu de navegação -->
    </nav>
  </header>

  <main>
    <section>
      <h1>[Título principal da tela]</h1>
      <!-- conteúdo principal -->
    </section>
  </main>

  <footer>
    <!-- rodapé -->
  </footer>

  <script src="../_common/scripts/HttpClientBase.js"></script>
  <script src="scripts/[nome-da-tela].js"></script>
</body>
</html>
```

> ❌ Nunca usar `<div>` como estrutura de layout  
> ❌ Nunca usar `<table>` exceto para dados tabulares reais  
> ✅ Preferir: `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<aside>`, `<footer>`, `<ul>`, `<ol>`, `<figure>`, `<form>`, `<fieldset>`

---

## Padrão de JavaScript

```js
// ✅ Seleção de elementos
const btnSubmit = document.querySelector("#btn-submit");
const listItems = document.querySelectorAll(".item-card");

// ✅ Eventos registrados via código, nunca inline no HTML
btnSubmit.addEventListener("click", handleSubmit);

function handleSubmit(event) {
  event.preventDefault();
  // lógica aqui
}

// ✅ Futuro: requisições via HttpClientBase.js (não implementar ainda na etapa estática)
// const client = new HttpClientBase();
// client.get("/api/recurso").then(...).catch(...);
```

> ❌ Nunca usar `onclick=""`, `onsubmit=""` ou qualquer evento inline no HTML  
> ❌ Nunca usar `jQuery` ou `$(...)`  
> ❌ Nunca usar `getElementById` — usar sempre `document.querySelector`

---

## Organização de arquivos

| O que criar | Onde colocar |
|---|---|
| CSS comum a todas as áreas | `views/assets/_common/styles/` |
| JS utilitário (helpers, HttpClientBase) | `views/assets/_common/scripts/` |
| Telas e estilos da área pública | `views/assets/public/` |
| Telas e estilos da área logada | `views/assets/app/` |
| Telas e estilos do painel admin | `views/assets/admin/` |

Nomenclatura sugerida: `kebab-case` para arquivos e pastas.  
Exemplo: `views/assets/public/styles/login.css`, `views/assets/app/scripts/dashboard.js`

---

## Como marcar conteúdo estático para integração futura

```html
<!-- TODO: substituir por dado real da API GET /api/usuarios -->
<ul>
  <li>João Silva</li>
  <li>Maria Souza</li>
</ul>
```

```js
// TODO: substituir por chamada real via HttpClientBase.js
const produtos = [
  { id: 1, nome: "Produto A" },
  { id: 2, nome: "Produto B" },
];
```

---

## Checklist antes de entregar código de frontend

- [ ] HTML usa apenas tags semânticas
- [ ] Nenhum `<div>` ou `<table>` usado para estrutura de layout
- [ ] CSS em arquivo separado, sem `style` inline
- [ ] JS em arquivo separado, sem eventos inline no HTML
- [ ] Seleção de elementos usa `document.querySelector`
- [ ] Conteúdo estático temporário marcado com `TODO`
- [ ] Arquivo salvo na pasta correta da área (`public`, `app` ou `admin`)
- [ ] Recursos compartilhados salvos em `_common`
- [ ] Texto e comentários em Português do Brasil
- [ ] Código, nomes de funções, classes e variáveis em English

