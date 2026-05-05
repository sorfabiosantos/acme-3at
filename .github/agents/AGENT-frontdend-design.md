# AGENT de Frontend Design

## Objetivo deste arquivo
Use este documento para orientar o planejamento visual e estrutural do frontend do sistema. Ele deve ajudar **estudantes** a descrever suas decisões de interface e também orientar **agentes de IA** a propor telas, componentes e organização de arquivos sem quebrar as convenções do projeto.

## Como preencher
- Substitua cada conteúdo entre colchetes por informações do seu sistema.
- Escreva descrições curtas, objetivas e úteis para implementação.
- Registre primeiro o **layout estático**; o consumo da API e a renderização dinâmica virão depois.

## Regras do projeto que devem ser respeitadas
- O conteúdo deve ser escrito em **Português do Brasil**.
- O código, nomes de arquivos, classes, funções e identificadores devem ficar em **English**.
- O frontend deve usar **HTML semântico**.
- Não utilizar `<div>` e não utilizar `<table>` para montar interface.
- Não utilizar `jQuery`.
- Não utilizar eventos inline no HTML.
- Usar `document.querySelector` no JavaScript.
- Requisições HTTP devem usar `HttpClientBase.js` quando a integração com API começar.
- Arquivos compartilhados devem ir em `views/assets/_common/`; arquivos específicos devem ficar em `views/assets/public/`, `views/assets/app/` ou `views/assets/admin/`.

## Escopo inicial do frontend
- Nesta etapa, os dados serão exibidos de forma **estática**.
- O JavaScript poderá ser usado para comportamentos como `[menu responsivo]`, `[abrir e fechar painéis]`, `[alternar listas]`, `[máscaras visuais]` e `[interações de navegação]`.
- Não planeje regra de negócio no frontend; a View apenas apresenta dados e interações da interface.

## Contexto geral da interface
- Nome do sistema: `[nome do sistema]`
- Objetivo principal: `[descreva o que o sistema resolve]`
- Público principal: `[quem usará o sistema]`
- Dispositivos prioritários: `[mobile, desktop, tablet ou combinação]`
- Estilo desejado: `[moderno, institucional, minimalista, acadêmico, comercial...]`

## Área Pública (`public`)
- Quem acessa: `[visitantes sem login]`
- Objetivo da área: `[ex.: apresentar o sistema, captar interesse, permitir login/cadastro]`
- Telas previstas: `[home]`, `[sobre]`, `[contato]`, `[login]`, `[cadastro]`
- Componentes principais: `[cabeçalho]`, `[menu]`, `[banner]`, `[seção de destaque]`, `[rodapé]`
- Ação principal esperada do usuário: `[o que o visitante deve fazer nesta área]`

## Área de Aplicação (`app`)
- Quem acessa: `[usuário autenticado]`
- Objetivo da área: `[ex.: acompanhar dados, realizar operações, consultar informações]`
- Telas previstas: `[dashboard]`, `[perfil]`, `[listagem]`, `[detalhes]`, `[configurações]`
- Componentes principais: `[menu lateral]`, `[barra superior]`, `[cards]`, `[formulários]`, `[listas]`
- Ação principal esperada do usuário: `[o que o usuário logado faz com mais frequência]`

## Área Administrativa (`admin`)
- Quem acessa: `[administrador, secretaria, gestor, professor...]`
- Objetivo da área: `[ex.: gerenciar usuários, cadastros, permissões, relatórios]`
- Telas previstas: `[painel]`, `[gestão de usuários]`, `[cadastros]`, `[relatórios]`
- Componentes principais: `[tabelas semânticas apenas se forem dados tabulares reais]`, `[filtros]`, `[formulários]`, `[indicadores]`
- Ação principal esperada do usuário: `[principal tarefa administrativa]`

## Navegação e organização visual
- Estrutura de navegação principal: `[menu superior, lateral, abas, breadcrumbs...]`
- Fluxo entre telas: `[descreva o caminho mais comum do usuário]`
- Hierarquia visual: `[o que deve chamar mais atenção em cada área]`
- Estados importantes da interface: `[vazio]`, `[carregando]`, `[erro visual]`, `[sucesso]`

## Responsividade e acessibilidade
- Breakpoints desejados: `[mobile]`, `[tablet]`, `[desktop]`
- Ajustes esperados por tela: `[como menu, listas e formulários se adaptam]`
- Cuidados de acessibilidade: `[contraste]`, `[legibilidade]`, `[ordem lógica]`, `[textos claros]`
- Elementos semânticos esperados: `[header]`, `[nav]`, `[main]`, `[section]`, `[article]`, `[aside]`, `[footer]`

## Identidade visual
- Paleta principal: `[cores principais]`
- Tipografia: `[família tipográfica ou estilo desejado]`
- Referências visuais: `[sites, sistemas ou estilos de inspiração]`
- Sensação que a interface deve transmitir: `[seriedade, confiança, rapidez, simplicidade...]`

## Organização de arquivos esperada
- Estilos compartilhados: `views/assets/_common/styles/[arquivo.css]`
- Scripts compartilhados: `views/assets/_common/scripts/[arquivo.js]`
- Estilos da área pública: `views/assets/public/styles/[arquivo.css]`
- Scripts da área pública: `views/assets/public/scripts/[arquivo.js]`
- Estilos da aplicação: `views/assets/app/styles/[arquivo.css]`
- Scripts da aplicação: `views/assets/app/scripts/[arquivo.js]`
- Estilos da área administrativa: `views/assets/admin/styles/[arquivo.css]`
- Scripts da área administrativa: `views/assets/admin/scripts/[arquivo.js]`

## Limite entre etapa atual e integração futura
- Agora: criar HTML semântico, CSS e interações estáticas em JavaScript.
- Depois: integrar com a API usando `HttpClientBase.js`, tratar erros assíncronos e renderizar dados dinamicamente.
- Ao propor código, a IA deve separar o que é **mock estático** do que será substituído por dados reais depois.

## Instrução final para estudantes e IA
Antes de implementar qualquer tela, preencha este arquivo com o máximo de clareza possível. Se uma informação ainda não estiver decidida, registre como `[a definir]` em vez de inventar requisitos.

