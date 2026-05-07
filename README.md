# Memphis — Painel Administrativo para ERP

Memphis é a interface administrativa de um futuro sistema ERP, construído do zero com uma stack moderna em Laravel. Atualmente em desenvolvimento inicial, com foco em estabelecer a fundação: sistema de layouts, componentes base de UI, internacionalização e uma camada de documentação viva.

---

## Visão Geral

Memphis é uma reformulação completa do painel administrativo de um ERP existente, substituindo ferramentas legadas por uma arquitetura limpa e sustentável. O projeto utiliza o tema Metronic 9 como base de design, adaptado via Tailwind CSS e integrado profundamente ao Laravel Livewire para componentes reativos no lado do servidor.

---

## Roadmap de Versões

Cada versão do Memphis carrega o nome de uma divindade egípcia, refletindo a fase e o espírito do que está sendo construído.

| Versão | Codinome | Divindade | Fase do Projeto |
|---|---|---|---|
| Dev | **Memphis** | Cidade histórica do Egito Antigo, grande centro político e cultural da civilização egípcia. | Ambiente principal de desenvolvimento. Base experimental onde a arquitetura, padrões e identidade visual começam a ser definidos. |
| 0.1.0 | **Isis** | Deusa da magia, criação, cura e proteção. | Início do projeto. Criação dos primeiros componentes de UI, definição visual inicial, layouts base e primeiras estruturas reutilizáveis. |
| 0.2.0 | **Ptah** | Deus criador associado à arquitetura, construção e artesanato. | Consolidação da fundação do sistema. Organização estrutural do frontend e backend, padronização de componentes e arquitetura inicial. |
| 0.3.0 | **Thoth** | Deus da sabedoria, escrita, conhecimento e organização. | Implementação de regras básicas, documentação inicial, helpers, formulários e melhorias de desenvolvimento. |
| 0.4.0 | **Ma'at** | Deusa da ordem, equilíbrio, verdade e justiça. | Padronização dos fluxos, validações, consistência de dados e primeiros CRUDs completos. |
| 0.5.0 | **Horus** | Deus dos céus, visão e poder real. | O sistema ganha visão e usabilidade real. Navegação estruturada, dashboards e primeiros módulos funcionais. |
| 0.6.0 | **Ra** | Deus do sol e da vida. | O núcleo do sistema ganha vida operacional. Autenticação, sessões, integrações iniciais e fluxos principais. |
| 0.7.0 | **Sobek** | Deus associado à força, proteção e adaptação. | Fortalecimento interno da aplicação. Melhorias de performance, estabilidade e crescimento estrutural. |
| 0.8.0 | **Khonsu** | Deus da lua e do controle do tempo. | Auditoria, logs, notificações, permissões e maior controle operacional da plataforma. |
| 0.9.0 | **Sekhmet** | Deusa da guerra e destruição, associada também à cura e proteção. | Preparação intensa para produção. Correções críticas, reforço de segurança e refinamentos gerais. |
| 1.0.0 | **Anubis** | Deus do julgamento, transição e proteção dos mortos. | Primeira grande versão estável. Plataforma pronta para uso real, segura, auditável e confiável. |
| 1.1.0 | **Osiris** | Deus da renovação, ressurreição e continuidade. | Grandes refatorações, evolução da arquitetura e renascimento estrutural do sistema. |
| 1.2.0 | **Bastet** | Deusa da proteção, harmonia e bem-estar. | Melhorias de UX, acessibilidade, segurança e refinamento visual da plataforma. |
| 1.3.0 | **Hathor** | Deusa da alegria, música, celebração e conexão humana. | Recursos colaborativos, comunicação interna e evolução da interação entre usuários e sistema. |
| 1.4.0 | **Set** | Deus do caos, transformação e tempestades. | Mudanças profundas na arquitetura, modernizações radicais e quebra de paradigmas antigos. |
| 1.5.0 | **Nephthys** | Deusa da proteção, suporte e estabilidade espiritual. | Confiabilidade, monitoramento contínuo, sustentação operacional e estabilidade da plataforma. |
| 2.0.0 | **Amun** | Deus supremo associado ao invisível, poder e grandeza. | O sistema se torna uma plataforma completa. Estrutura madura, modular, escalável e consolidada. |
| 2.1.0 | **Aten** | Representação divina do disco solar e da expansão da luz. | Crescimento tecnológico, integrações externas, automações e expansão funcional da plataforma. |
| 2.2.0 | **Thoth Reborn** | Evolução moderna do conhecimento e inteligência analítica. | Inteligência artificial, automações avançadas, relatórios estratégicos e análise orientada por dados. |
| 3.0.0 | **Ra Eternal** | Forma definitiva e eterna do deus solar. | Consolidação máxima da plataforma. Ecossistema completo, altamente integrado e preparado para crescimento contínuo. |

---

## Stack de Tecnologias

| Camada | Tecnologia |
|---|---|
| Backend | Laravel 13.x |
| Reatividade Frontend | Livewire 4.x |
| Tema de UI | Metronic 9 (Tailwind CSS) |
| Interatividade | Alpine.js 3.x |
| Build | Vite 6.x |
| Banco de Dados | MySQL |
| Node.js | LTS mais recente |

---

## Estrutura do Projeto

```
resources/views/
├── components/          # Componentes Blade reutilizáveis (app-logo, auth-header, etc.)
├── layouts/
│   ├── admin/           # 10+ variantes de layout admin (dark-sidebar, compact-sidebar, horizontal-menu, etc.)
│   ├── app/             # Shell da aplicação (header, sidebar)
│   └── auth/            # Layouts de autenticação (branded, card, simple, split)
├── pages/
│   ├── auth/            # Login, registro, redefinição de senha, 2FA, etc.
│   └── settings/        # Perfil, segurança, aparência, exclusão de conta (Livewire)
├── partials/            # Parciais compartilhados (head, scripts, topbar, mega-menu, theme-toggle, etc.)
└── flux/                # Overrides customizados do Flux (ícones, navlist)

app/
├── Livewire/            # Classes de componentes Livewire (Demo1, Demo2, Shared)
├── Services/            # MenuService (constrói e cacheia a árvore de menus)
├── View/
│   ├── Components/      # Contrapartes PHP dos componentes Blade de UI
│   └── Composers/       # SidebarMenuComposer (injeta $menuTree nas sidebars)
└── Actions/Fortify/     # Actions customizadas de autenticação via Fortify
```

---

## Configuração do Ambiente (Docker / Laravel Sail)

O projeto usa **Laravel Sail** para o ambiente de desenvolvimento via Docker.

```bash
# Subir o ambiente (em background)
./vendor/bin/sail up -d

# Parar o ambiente
./vendor/bin/sail down

# Acessar o shell do container
./vendor/bin/sail shell
```

### Alias recomendado (opcional)

Para usar o comando `sail` diretamente ao invés de `./vendor/bin/sail`, adicione o alias ao seu shell:

```bash
# Adicione ao ~/.bashrc ou ~/.zshrc
alias sail='./vendor/bin/sail'

# Recarregue o shell
source ~/.bashrc   # ou source ~/.zshrc
```

Após configurar o alias, todos os comandos podem ser executados de forma mais curta:

```bash
sail up -d
sail down
sail shell
```

> Todos os comandos `artisan`, `composer` e `npm` abaixo devem ser executados via `sail` quando o ambiente Docker estiver ativo.

---

## Primeiros Passos

### Instalação

```bash
# Instalar dependências dentro do container
sail composer install
sail npm install
```

### Desenvolvimento

```bash
# Rodar os dois juntos
sail artisan serve
sail npm run dev
```

### Produção

```bash
sail npm run build
```

### Banco de Dados

```bash
sail artisan migrate
sail artisan db:seed
sail artisan migrate:fresh --seed
```

### Testes

```bash
# Rodar um teste específico
sail artisan test --filter TestClassName
sail artisan test tests/Feature/SomeTest.php
```

### Cache

```bash
sail artisan optimize:clear
```

---

## E-mail (Desenvolvimento)

E-mails enviados pela aplicação são capturados pelo **Mailpit** (incluído no Sail). Para visualizar os e-mails recebidos, acesse:

**http://localhost:8025/**

---

## Rotas

| Caminho | Descrição |
|---|---|
| `/demo1` | Layout admin com sidebar (Demo1) |
| `/demo2` | Layout vertical (Demo2) |
| `/account/*` | Perfil do usuário, segurança, aparência, notificações |
| `/settings/*` | Empresa, usuários, roles, menus, integrações, parâmetros |

Todas as rotas requerem middleware `auth` + `verified`. As rotas estão em `routes/web.php` e resolvem para views via namespace `pages::` (mapeado para `resources/views/pages/`).

---

## Arquitetura

### Sistema de Layouts

- **Demo1** — shell admin tradicional baseado em sidebar
- **Demo2** — shell com layout vertical moderno
- **Parciais compartilhados** — head, scripts e theme-mode reutilizados entre os layouts

Os layouts ficam em `resources/views/layouts/admin/` e são mantidos completamente separados — não consolidá-los.

### Sistema de Menus

Menus são gerenciados via banco de dados (tabela `menus`) com hierarquia pai/filho. O `MenuService` (`app/Services/MenuService.php`) constrói e cacheia a árvore (TTL de 5 minutos via `Cache`). Chamar `MenuService::clearCache()` após qualquer alteração no menu. O model `Menu` possui scopes (`active()`, `roots()`, `ordered()`) e helpers (`url()`, `isActive()`, `hasActiveChild()`).

### Componentes de UI

Componentes Blade reutilizáveis ficam em `resources/views/components/ui/` e seus correspondentes PHP em `app/View/Components/`. Usar esses componentes para todo novo trabalho de UI.

### Ícones

Dois sistemas de ícones estão em uso:

- **Keenicons** — `<i class="ki-filled ki-icon-name"></i>` (conjunto de ícones do Metronic)
- **Lucide** — `@svg('lucide-icon-name')` (via `mallardduck/blade-lucide-icons`)

### Autenticação

Gerenciada pelo **Laravel Fortify** com actions customizadas em `app/Actions/Fortify/`. Autenticação de dois fatores está habilitada no model `User`.

### Decisões Técnicas

- **Livewire ao invés de Vue/React** — mantém o stack Laravel-nativo e reduz complexidade JavaScript
- **Tailwind CSS** — utility-first, alinha naturalmente com o design system do Metronic
- **Alpine.js** — camada de interatividade leve sem um framework JS completo
- **Vite** — build tool moderno com hot reloading durante o desenvolvimento

---

## Sistema de Estilos

- **Tailwind CSS 4.x** com utilitários customizados do Metronic
- **Classes CSS customizadas** usando prefixo `kt-*`
- **Modo escuro** com suporte a alternância de tema (via classe `.dark`)
- **Design responsivo** com abordagem mobile-first
- **Propriedades CSS customizadas** alinhadas ao design system do Metronic

---

## Convenções Importantes

- Componentes Livewire usam `wire:model` para bindings de formulário e `wire:navigate` para transições SPA-like
- O model `User` possui helper `initials()` utilizado para exibição de avatar
- `AppServiceProvider` força datas imutáveis (Carbon) e previne comandos Eloquent destrutivos fora de produção
- Modo escuro é alternado via classe CSS `.dark`

---

## Funcionalidades

### Concluídas

#### Layouts
- **Layout admin** — shell admin completo com sidebar (10+ variantes)
- **Layout de autenticação** — shell limpo para páginas de autenticação

#### Páginas de Autenticação
- Login, Registro, Redefinição de Senha (e páginas relacionadas)

#### Internacionalização
- Mecanismo de troca de idioma com suporte a `lang`
- Aplicado ao layout core e páginas de autenticação
- Pendente: tradução das demais páginas e componentes

#### Componentes de UI (com documentação e exemplos)
- Alert
- Badge
- Button
- Input
- Input Group
- Select

---

### Classes PHP Livewire (Pendentes)

```
app/Livewire/Demo1/NavigationMenu.php
app/Livewire/Demo1/SidebarToggle.php
app/Livewire/Demo1/UserDropdown.php

app/Livewire/Demo2/NavigationMenu.php
app/Livewire/Demo2/BalanceWidget.php
app/Livewire/Demo2/UserDropdown.php

app/Livewire/Shared/ThemeMode.php
app/Livewire/Shared/SearchBox.php
app/Livewire/Shared/NotificationDropdown.php
```

---

### Roadmap de Componentes

| Componente | Status |
|---|---|
| Accordion | Pendente |
| Alert | Concluído |
| Avatar | Pendente |
| Badge | Concluído |
| Breadcrumb | Pendente |
| Button | Concluído |
| Card | Pendente |
| Checkbox | Pendente |
| Collapse | Pendente |
| Datatable | Pendente |
| Dismiss | Pendente |
| Drawer | Pendente |
| Dropdown | Pendente |
| Image | Pendente |
| Input | Concluído |
| Input Group | Concluído |
| Input Update | Pendente |
| Kbd | Pendente |
| Link | Pendente |
| Modal | Pendente |
| Pagination | Pendente |
| Progress | Pendente |
| Radio Group | Pendente |
| Rating | Pendente |
| Reparent | Pendente |
| Repeater | Pendente |
| Scrollable | Pendente |
| Scrollspy Update | Pendente |
| Scrollto | Pendente |
| Select | Concluído |
| Separator | Pendente |
| Skeleton | Pendente |
| Stepper | Pendente |
| Sticky | Pendente |
| Switch | Pendente |
| Tabs | Pendente |
| Textarea | Pendente |
| Theme Switch | Pendente |
| Toast | Pendente |
| Toggle | Pendente |
| Toggle Group | Pendente |
| Toggle Password | Pendente |
| Tooltip | Pendente |

---

### Roadmap de Internacionalização

- [x] Mecanismo de troca de idioma
- [x] Páginas de autenticação traduzidas
- [ ] Layout admin traduzido
- [ ] Todos os componentes de UI traduzidos
- [ ] Todas as demais páginas traduzidas

---

### Funcionalidades Planejadas

- **Seletor de fonte padrão** — preferência do usuário/sistema para alterar a família de fonte utilizada em todo o painel administrativo

---

## Comandos Artisan

```bash
# Traduzir strings de um arquivo/módulo
php artisan ai:translate sign --from=en --to=pt_BR
```

---

## Contribuindo

Ao adicionar novos componentes ou funcionalidades:

1. Siga a estrutura de diretórios estabelecida
2. Use a sintaxe Blade correta com `{{-- comentários --}}`
3. Use `wire:model` para bindings de formulários Livewire e `wire:navigate` para transições SPA-like
4. Mantenha design responsivo com abordagem mobile-first
5. Adicione documentação com exemplos funcionais para cada novo componente
6. Garanta que novos componentes suportem internacionalização desde o início

---

## Licença

O código do Memphis admin é proprietário, desenvolvido como parte de um sistema ERP interno. O tema Metronic é utilizado sob sua licença comercial.
