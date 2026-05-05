# 📁 api/

## O Back-End — A API REST em PHP

---

### 🎯 Para que serve esta pasta?

A pasta `api/` contém todo o **código do servidor** (back-end). Aqui é onde o PHP processa as
requisições vindas do front-end e retorna respostas, geralmente em formato **JSON**.

Esta pasta funciona como uma **API REST** — ou seja, ela **não gera HTML**. Ela apenas recebe
requisições e devolve dados, sendo assim, aqui é necessário esquecer que existe `echo` ou `var_dump` — tudo deve ser retornado em JSON.

---

### 📦 O que é uma API REST?

**API** (Application Programming Interface) é uma interface que permite a comunicação entre sistemas.

**REST** (Representational State Transfer) é um padrão que utiliza os métodos HTTP:

| Método HTTP | Ação no banco de dados | Exemplo                    |
|-------------|------------------------|----------------------------|
| `GET`       | **Ler** dados          | Buscar lista de usuários   |
| `POST`      | **Criar** dados        | Cadastrar um novo usuário  |
| `PUT`       | **Atualizar** dados    | Editar dados de um usuário |
| `DELETE`    | **Excluir** dados      | Remover um usuário         |

> 💡 Esses 4 métodos formam o famoso **CRUD** (Create, Read, Update, Delete).

---

### 📂 Estrutura desta pasta

```
api/
├── .htaccess        ← Configuração do Apache para URLs amigáveis
├── composer.json    ← Arquivo de configuração do Composer (dependências)
├── index.php        ← Front Controller — ponto de entrada de TODAS as requisições
├── vendor/          ← Bibliotecas instaladas pelo Composer (NÃO editar!)
└── source/          ← Código-fonte da API
```

---

### 🔑 Arquivos importantes

#### `index.php` — Front Controller
Este é o **ponto de entrada** da API. Toda requisição que chega ao servidor passa por aqui primeiro.
Ele é responsável por:
- Carregar o autoload do Composer
- Iniciar o roteamento (Router)
- Direcionar a requisição para o Controller correto

#### `.htaccess` — Reescrita de URL
Este arquivo configura o Apache para redirecionar **todas** as requisições para o `index.php`.
Por exemplo, ao acessar `api/usuarios`, o Apache reescreve internamente para `api/index.php?route=/usuarios`.

```apache
RewriteEngine On
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteRule ^(.*)$ index.php?route=/$1 [L,QSA]
```

#### `composer.json` — Gerenciador de Dependências
O Composer é o gerenciador de pacotes do PHP (similar ao `npm` do JavaScript).
Aqui definimos as dependências do projeto e o **autoload** das classes.

---

### 🔗 Relação com o MVC

```
index.php (Front Controller)
    ↓
Router (Core/Router.php) → identifica a rota
    ↓
Controller (Controller/Api.php) → processa a lógica
    ↓
Model (Models/User.php) → acessa o banco de dados
    ↓
Resposta JSON → enviada ao front-end
```

---

> 📚 Acesse a pasta `source/` para entender cada camada do MVC em detalhes.

