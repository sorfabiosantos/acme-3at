# 📁 data-base/

## Banco de Dados — Scripts SQL

---

### 🎯 Para que serve esta pasta?

A pasta `data-base/` armazena os **scripts SQL** necessários para criar e popular o banco de
dados do projeto. Isso garante que qualquer pessoa da equipe consiga **recriar o banco**
facilmente.

---

### 📂 Conteúdo desta pasta

```
data-base/
└── dump.sql    ← Script SQL com a estrutura e dados do banco
```

---

### 📖 O que é um dump SQL?

Um **dump** (despejo) SQL é um arquivo que contém comandos SQL para:

1. **Criar** o banco de dados (`CREATE DATABASE`)
2. **Criar** as tabelas (`CREATE TABLE`)
3. **Inserir** dados iniciais (`INSERT INTO`)

---

### 💡 Exemplo de conteúdo do dump.sql

```sql
-- ============================================
-- Criação do banco de dados
-- ============================================
CREATE DATABASE IF NOT EXISTS acme_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE acme_db;

-- ============================================
-- Tabela de usuários
-- ============================================
CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100)  NOT NULL,
    email      VARCHAR(150)  NOT NULL UNIQUE,
    password   VARCHAR(255)  NOT NULL,
    created_at TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- Dados iniciais (seed)
-- ============================================
INSERT INTO users (name, email, password) VALUES
    ('Administrador', 'admin@acme.com', MD5('123456')),
    ('Estudante', 'estudante@acme.com', MD5('123456'));
```

---

### 🚀 Como usar?

1. Abra o **phpMyAdmin** ou outro cliente MySQL
2. Copie o conteúdo do arquivo `dump.sql`
3. Cole na aba **SQL** e clique em **Executar**
4. Pronto! O banco de dados está criado e populado

Ou pelo terminal:
```bash
mysql -u root -p < dump.sql
```

---

### 🔐 Boas práticas

- ✅ Sempre mantenha o dump atualizado quando alterar o banco
- ✅ Use `IF NOT EXISTS` para evitar erros ao executar novamente
- ✅ Inclua dados de exemplo (seeds) para facilitar os testes
- ❌ **NUNCA** inclua senhas reais de produção no dump

---

> 💡 **Dica:** Sempre que adicionar uma nova tabela ao projeto, atualize o `dump.sql`
> para que todos da equipe tenham a mesma estrutura.

