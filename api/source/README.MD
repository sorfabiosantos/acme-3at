# 📁 api/source/

## O Código-Fonte — Organização MVC

---

### 🎯 Para que serve esta pasta?

A pasta `source/` contém **todo o código-fonte** escrito por nós, organizado seguindo o padrão **MVC**.
Cada subpasta tem uma responsabilidade clara e específica.

---

### 📂 Estrutura desta pasta

```
source/
├── Config/         ← Configurações do sistema (banco, constantes)
├── Controller/     ← Controllers — recebem requisições e retornam respostas
├── Core/           ← Núcleo — classes fundamentais do framework (Router, Connect)
├── Models/         ← Models — representam as tabelas do banco de dados
└── Support/        ← Helpers — funções utilitárias auxiliares
```

---

### 🧩 Como as pastas se relacionam?

```
Requisição HTTP
      ↓
[Core/Router.php]       → Analisa a URL e encontra o Controller certo
      ↓
[Controller/Api.php]    → Executa a lógica de negócio
      ↓
[Models/User.php]       → Consulta/salva dados no banco
      ↓
[Core/Connect.php]      → Fornece a conexão PDO com o banco
      ↓
[Config/Config.php]     → Fornece as credenciais e configurações
      ↓
[Support/Helpers.php]   → Funções auxiliares usadas em qualquer lugar
```

---

### 📖 Conceito: Namespaces em PHP

Cada pasta corresponde a um **namespace** (espaço de nomes) no PHP.
Namespaces organizam as classes e evitam conflitos de nomes.

```php
// A classe User está no namespace source\Models
namespace source\Models;

class User
{
    // ...
}
```

Para usar essa classe em outro arquivo:
```php
use source\Models\User;

$usuario = new User();
```

> 💡 O **Composer** faz o carregamento automático (autoload) das classes baseado nos namespaces.

---

> 📚 Acesse cada subpasta para entender sua responsabilidade em detalhes.

