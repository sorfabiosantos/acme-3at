# Título da Aplicação

## Visão Geral

[contexto-geral-da-realidade-resumo-aprovado]

O conteúdo será em `Brazilian Portuguese`, o código em `English`.

## Tecnologias Utilizadas

O sistema será desenvolvido utilizando o padrão MVC (Model-View-Controller):
- Controller: Responsável por receber as requisições, processar a lógica e decidir qual resposta enviar, orquestrando e retornando JSON.
- Model: Representa os dados e as regras de negócio. Faz a comunicação com o banco de dados.
- View/asses: É a interface do usuário. Consome a API e não deve conter regras de negócio.

### Backend - Web Service
- PHP
- Composer
- Para o gerenciamento das rotas do webservice, será utilizada a biblioteca `coffeecode/router`.

### Frontend
- HTML 
  - utilizar tags semânticas;
  - não utilizar `<div>` e `<table>`;
- CSS
  - elementos comuns poderão ser exportados para a pasta `assets/_common/styles/`;
- JavaScript 
  - não utilizar jQuery; 
  - não utilizar eventos inline;
  - utilizar `document.querySelector` para selecionar elementos;
  - utilizar a classe `HttpClientBase.js` para requisições HTTP;
  - sempre tratar erros em requisições assíncronas;
  - funcionalidades semelhantes poderão ser exportadas, para isso utilizar a pasta `assets/_common/scripts/`;

### Banco de Dados
- MySQL

## Variáveis de Ambiente
- .env

```
CONF_DB_HOST=
CONF_DB_NAME=
CONF_DB_USER=
CONF_DB_PORT=

```

## Estruturas de Pastas do Projeto

```
nome-pasta-do-projeto/
│
├── index.html          ← Página inicial (ponto de entrada do front-end)
├── README.MD           ← Este arquivo (documentação geral do projeto)
│
├── api/                ← Back-end: API REST em PHP (onde mora o MVC)
│   ├── index.php       ← Ponto de entrada da API (Front Controller)
│   ├── .env            ← Variáveis de ambiente (configurações sensíveis)
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

## Agents

Consulte agents na pasta `.github/agents/`

## Skills

Consulte skills na pasta `.github/skills/`