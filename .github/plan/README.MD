# 📋 Pasta Plan — Planejamento e Orientações para IA

## Visão Geral

Esta pasta (`/.github/plan/`) é um **repositório centralizado de planejamento** do projeto ACME. Ela contém documentos estratégicos que descrevem:

- 📐 **Planejamento geral do sistema** — arquitetura, fluxos, escopo de funcionalidades
- 🎯 **Visão e contexto** — o "por quê" por trás das decisões do projeto
- 🤖 **Orientações para IA** — instruções específicas para guiar agentes e assistentes de código na implementação

---

## Para que serve?

### 1. **Documentação de Planejamento**

Cada arquivo `.md` nesta pasta documenta um aspecto importante do projeto antes da implementação:

- `01-plan-frontend-layout.md` — Definição das interfaces, áreas do sistema (pública, app, admin), componentes visuais
- `01-plan-web-service.md` — Arquitetura da API, endpoints, fluxos de requisição/resposta, autenticação
- Futuros arquivos — Banco de dados, fluxo de autenticação, casos de uso, etc.

### 2. **Referência Prática para Implementação**

Agentes de IA e desenvolvedores usam esses documentos para:

- ✅ Entender o escopo exato das funcionalidades antes de codificar
- ✅ Manter consistência com decisões arquiteturais já documentadas
- ✅ Evitar retrabalho e erros de design
- ✅ Orientar o desenvolvimento camada por camada (backend → frontend)

### 3. **Guia para Agentes de Código**

Quando um agente de IA (como GitHub Copilot, Claude, ou Cursor) trabalha neste projeto, ele deve:

1. **Ler os planos** desta pasta para entender a visão geral
2. **Consultar AGENTS.md** (raiz do projeto) para conhecer as convenções técnicas
3. **Consultar .github/copilot-instructions.md** para regras específicas de linguagem e estilo
4. **Implementar respeitando** a arquitetura MVC documentada nos planos

---

## Estrutura de Arquivos

```
.github/plan/
├── README.MD                    ← Este arquivo (orientação geral)
├── 01-plan-frontend-layout.md   ← Planejamento da interface do usuário
├── 01-plan-web-service.md       ← Planejamento da API REST
└── [futuros arquivos de plan]
```

---

## Como Usar Esta Pasta

### Para Desenvolvedores/Agentes que estão Começando

1. Leia este `README.MD` para entender o contexto geral
2. Consulte os arquivos de planejamento relevantes (ex: `01-plan-frontend-layout.md` se vai trabalhar no front)
3. Implemente seguindo a arquitetura MVC documentada
4. Após implementar, mantenha os planos atualizados com ajustes realizados

### Para Agentes de IA

1. Ao receber uma tarefa, procure o arquivo de planejamento correspondente
2. Use o planejamento como "contrato" — não desvie dele sem justificativa explícita
3. Se precisar fazer mudanças no escopo, documente no arquivo de planejamento
4. Sempre mantenha a linguagem dos documentos: prosa em **português do Brasil**, código em **English**

---

## Convenções de Nomenclatura

- **Números + nome descritivo**: 
  - `01-plan-frontend-layout.md`, 
  - `02-plan-frontend-layout.md`,
  - `01-plan-web-service.md`,
  - `02-plan-web-service.md`,
  - `01-plan-database.md`, 
  - `02-plan-database.md`, etc.
- Isso facilita a ordenação lógica dos planos (fase 1, fase 2, etc.)

---

## Informações Complementares

- 📖 Para detalhes técnicos e convenções de código, consulte `AGENTS.md` (raiz do projeto)
- 🎓 Para instruções específicas de linguagem/estilo, consulte `.github/copilot-instructions.md`
- 📚 Para entender a estrutura MVC, consulte `README.MD` (raiz) e `api/source/README.MD`

