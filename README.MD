# 📁 ACME - Projeto Didático MVC

## Programação Web II — Técnico em Informática

---

### 🎯 Objetivo do Projeto

Este projeto tem como objetivo ensinar o padrão de arquitetura **MVC (Model-View-Controller)** utilizando
**PHP** no back-end e **HTML, CSS e JavaScript** no front-end.

---

### 🧱 O que é MVC?

O **MVC** é um padrão de arquitetura de software que separa a aplicação em três camadas principais:

| Camada         | Responsabilidade                                                                 |
|----------------|----------------------------------------------------------------------------------|
| **Model**      | Representa os dados e as regras de negócio. Faz a comunicação com o banco de dados. |
| **View**       | É a interface do usuário. Tudo que o usuário vê (HTML, CSS, JS).                 |
| **Controller** | Recebe as requisições, processa a lógica e decide qual resposta enviar.          |

```
Usuário → [View] → [Controller] → [Model] → Banco de Dados
                                      ↓
                              Resposta ao Usuário
```

---

### 📂 Estrutura de Pastas do Projeto

```
acme-3am-g1/
│
├── index.html          ← Página inicial (ponto de entrada do front-end)
├── README.MD           ← Este arquivo (documentação geral do projeto)
│
├── api/                ← Back-end: API REST em PHP (onde mora o MVC)
│   ├── index.php       ← Ponto de entrada da API (Front Controller)
│   ├── .htaccess       ← Reescrita de URLs amigáveis (Apache)
│   ├── composer.json   ← Gerenciador de dependências PHP
│   ├── vendor/         ← Bibliotecas de terceiros (autoload do Composer)
│   └── source/         ← Código-fonte organizado em MVC
│       ├── Config/     ← Configurações (banco de dados, constantes, etc.)
│       ├── Controller/ ← Controllers — lógica das rotas da API
│       ├── Core/       ← Núcleo do sistema (conexão com BD, roteador)
│       ├── Models/     ← Models — representação das tabelas do banco
│       └── Support/    ← Funções auxiliares (helpers)
│
├── data-base/          ← Scripts SQL para criação do banco de dados
│
├── storage/            ← Armazenamento de arquivos (uploads, logs, etc.)
│
└── views/              ← Front-end: Interfaces do usuário
    └── assets/         ← Recursos estáticos (CSS, JS, imagens)
        ├── _common/    ← Recursos compartilhados entre todas as views
        ├── admin/      ← Recursos do painel administrativo
        ├── app/        ← Recursos da área logada (aplicação)
        └── public/     ← Recursos da área pública (visitante)
```

---

### 🚀 Como funciona o fluxo?

1. O **usuário** acessa a página pelo navegador (`index.html` ou uma view).
2. O **JavaScript** do front-end faz requisições para a **API** (`api/`).
3. O **Router** (`Core/Router.php`) recebe a URL e direciona para o **Controller** correto.
4. O **Controller** (`Controller/Api.php`) processa a requisição e consulta o **Model**.
5. O **Model** (`Models/User.php`) busca ou salva dados no **banco de dados**.
6. A resposta é enviada em **JSON** de volta ao front-end.
7. O **JavaScript** atualiza a tela com os dados recebidos.

---

### 📚 Tecnologias Utilizadas

| Tecnologia   | Uso                              |
|--------------|----------------------------------|
| **PHP**      | Back-end (API REST com MVC)      |
| **HTML**     | Estrutura das páginas            |
| **CSS**      | Estilização das páginas          |
| **JavaScript** | Interatividade e consumo da API |
| **MySQL**    | Banco de dados relacional        |
| **Composer** | Gerenciador de dependências PHP  |
| **Apache**   | Servidor web com reescrita de URL|

---

> 💡 **Dica:** Cada pasta possui seu próprio `README.MD` com explicações detalhadas.
> Navegue pelas pastas para aprender mais sobre cada parte do projeto!
