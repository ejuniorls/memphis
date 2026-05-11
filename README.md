# Memphis - Painel Administrativo para ERP

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
| Reatividade Frontend | Livewire 4.x + Flux 2.x |
| Tema de UI | Metronic 9 (Tailwind CSS) |
| Interatividade | Alpine.js 3.x |
| Build | Vite 8.x |
| Banco de Dados | MySQL |
| Node.js | LTS mais recente |

---

## Estrutura do Projeto

```
resources/views/
├── components/
│   ├── ui/                  # Componentes Blade reutilizáveis de UI (20+ componentes)
│   └── *.blade.php          # Componentes globais (app-logo, auth-header, etc.)
├── layouts/
│   ├── admin/               # 9 variantes de layout admin (dark-sidebar, compact-sidebar, etc.)
│   └── auth/                # Layouts de autenticação (branded, classic)
├── pages/
│   ├── account/             # Perfil, segurança, aparência, notificações (Livewire inline)
│   ├── auth/                # Login, registro, redefinição de senha, 2FA, etc.
│   ├── settings/            # Empresa, usuários, roles, menus, integrações, sistema (Livewire inline)
│   └── dashboard.blade.php  # Dashboard principal (Livewire inline)
└── partials/                # Parciais compartilhados (head, scripts, topbar, theme-toggle, etc.)

app/
├── Livewire/Actions/        # Apenas Logout.php — páginas usam classes inline (Volt-style)
├── Services/                # MenuService (constrói e cacheia a árvore de menus)
├── View/
│   ├── Components/ui/       # Contrapartes PHP dos componentes Blade de UI
│   └── Composers/           # SidebarMenuComposer (injeta $menuTree nas sidebars)
└── Actions/Fortify/         # Actions customizadas de autenticação via Fortify
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
| `/dashboard` | Dashboard principal |
| `/account/profile` | Perfil do usuário logado |
| `/account/security` | Segurança (senha, 2FA) |
| `/account/appearance` | Preferências de aparência |
| `/account/notifications` | Preferências de notificações |
| `/settings/company` | Dados da empresa (geral, fiscal, contato) |
| `/settings/users` | Gestão de usuários (CRUD + convite) |
| `/settings/roles` | Gestão de cargos/funções (CRUD) |
| `/settings/menus` | Gestão do menu de navegação (CRUD) |
| `/settings/integrations` | Integrações externas (CRUD) |
| `/settings/system` | Parâmetros de sistema, backup, log de auditoria |
| `/ui` | Showcase de componentes de UI |

Todas as rotas requerem middleware `auth` + `verified`. As rotas estão em `routes/web.php` e resolvem para views via namespace `pages::` (mapeado para `resources/views/pages/`).

---

## Arquitetura

### Sistema de Layouts

O projeto possui **9 variantes de layout admin** e **2 layouts de autenticação**, todos mantidos em `resources/views/layouts/`. Não consolidá-los — cada variante serve um padrão visual distinto.

#### Layouts Admin (`resources/views/layouts/admin/`)

| Variante | Arquivo | Descrição |
|---|---|---|
| Dark Sidebar | `dark-sidebar.blade.php` | Layout principal do projeto. Sidebar escura com menu dinâmico em 3 níveis, agrupado por seções. |
| Default | `default.blade.php` | Layout padrão claro, com variantes de página embutidas (index, profile, settings, users). |
| Compact Sidebar | `compact-sidebar.blade.php` | Sidebar reduzida com ícones e rótulos condensados. |
| Dropdown Menu | `dropdown-menu.blade.php` | Sidebar com menu em dropdown ao hover/click. |
| Dual Row Header | `dual-row-header.blade.php` | Header em duas linhas — branding + navbar separados. |
| Extended Header | `extended-header.blade.php` | Header com área estendida para ações e filtros contextuais. |
| Horizontal Menu | `horizontal-menu.blade.php` | Navegação 100% horizontal, sem sidebar. |
| Multiple Menus | `multiple-menus.blade.php` | Sidebar com múltiplos menus independentes. |
| Advanced Mega Menu | `advanced-mega-menu.blade.php` | Mega menu avançado com colunas e destaque visual. |
| Two Column Sidebar | `two-column-sidebar.blade.php` | Sidebar dupla: coluna primária de ícones + coluna secundária de itens. |

#### Layouts de Autenticação (`resources/views/layouts/auth/`)

| Variante | Arquivo | Descrição |
|---|---|---|
| Branded | `branded.blade.php` | Layout com identidade visual da empresa, ideal para login principal. |
| Classic | `classic.blade.php` | Layout simples e limpo, sem imagem de fundo. |

Cada layout admin é autocontido e possui seus próprios sub-partials (`header`, `sidebar`, `footer`, `toolbar`, `navbar`, e `partials/` internos quando necessário).

### Sistema de Menus

Menus são gerenciados via banco de dados (tabela `menus`) com hierarquia pai/filho. O `MenuService` (`app/Services/MenuService.php`) constrói e cacheia a árvore (TTL de 5 minutos via `Cache`). Chamar `MenuService::clearCache()` após qualquer alteração no menu. O model `Menu` possui scopes (`active()`, `roots()`, `ordered()`) e helpers (`url()`, `isActive()`, `hasActiveChild()`).

### Páginas e Livewire

As páginas usam o padrão **Livewire Volt** com classes anônimas inline: a lógica do componente fica declarada com `new class extends Component` diretamente no topo do arquivo `.blade.php`, sem criar um arquivo PHP separado. Apenas a action `app/Livewire/Actions/Logout.php` existe como classe Livewire standalone.

```php
<?php
// resources/views/pages/account/profile.blade.php
new #[Title('Meu Perfil')] class extends Component {
    use WithFileUploads;
    // ...
};
?>
<div>...</div>
```

Páginas de autenticação (login, registro, redefinição de senha, etc.) são views Blade puras processadas pelo **Laravel Fortify** — não têm lógica Livewire inline.

### Componentes de UI

Componentes Blade reutilizáveis ficam em `resources/views/components/ui/` e seus correspondentes PHP em `app/View/Components/ui/`. Componentes sem PHP class associada são componentes anônimos (apenas Blade). Usar esses componentes para todo novo trabalho de UI.

### Ícones

Dois sistemas de ícones estão em uso:

- **Keenicons** — `<i class="ki-filled ki-icon-name"></i>` (conjunto de ícones do Metronic)
- **Lucide** — `@svg('lucide-icon-name')` (via `mallardduck/blade-lucide-icons`)

### Autenticação

Gerenciada pelo **Laravel Fortify** com actions customizadas em `app/Actions/Fortify/`. Autenticação de dois fatores está habilitada no model `User`.

### Decisões Técnicas

- **Livewire ao invés de Vue/React** — mantém o stack Laravel-nativo e reduz complexidade JavaScript
- **Livewire Volt (classes inline)** — lógica e template no mesmo arquivo, sem proliferação de classes PHP avulsas
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
- **9 variantes de layout admin** — dark-sidebar, default, compact-sidebar, dropdown-menu, dual-row-header, extended-header, horizontal-menu, multiple-menus, advanced-mega-menu, two-column-sidebar
- **2 layouts de autenticação** — branded, classic

#### Páginas de Autenticação
- Login, Registro, Redefinição de Senha, Verificação de E-mail, Confirmação de Senha, 2FA, Boas-vindas, E-mail enviado, Senha alterada

#### Account (configurações do usuário logado)
- Perfil (avatar com crop 1:1, upload drag & drop, dados pessoais, contatos)
- Segurança (troca de senha, configuração de 2FA)
- Aparência (tema, modo escuro/claro)
- Notificações

#### Settings (configurações globais — admin)
- Empresa: dados gerais, dados fiscais, contato
- Usuários: listagem, criação, edição, convite
- Cargos/Funções: listagem, criação, edição
- Menus: listagem, criação, edição (gerenciamento do menu dinâmico)
- Integrações: listagem, criação, edição
- Sistema: parâmetros, backup, log de auditoria

#### Internacionalização
- Mecanismo de troca de idioma com suporte a `lang`
- Aplicado ao layout core e páginas de autenticação

---

### Roadmap de Componentes

| Componente | Blade | PHP Class | Status |
|---|---|---|---|
| Accordion | — | — | Pendente |
| Alert | `alert.blade.php` | `Alert.php` | Concluído |
| Avatar | — | — | Pendente |
| Badge | `badge.blade.php` | `Badge.php` | Concluído |
| Breadcrumb | `breadcrumb.blade.php` | `Breadcrumb.php` | Concluído |
| Button | `button.blade.php` | `Button.php` | Concluído |
| Card Section | `card-section.blade.php` | — | Concluído |
| Checkbox | `checkbox.blade.php` | — | Concluído |
| Collapse | — | — | Pendente |
| Datatable | — | — | Pendente |
| Dismiss | — | — | Pendente |
| Divider | `divider.blade.php` | — | Concluído |
| Drawer | — | — | Pendente |
| Dropdown | — | — | Pendente |
| File Dropzone | `file-dropzone.blade.php` | `FileDropzone.php` | Concluído |
| Form Field | `form-field.blade.php` | — | Concluído |
| Icon Box | `icon-box.blade.php` | `IconBox.php` | Concluído |
| Image Cropper | `image-cropper.blade.php` | — | Concluído |
| Input | `input.blade.php` | `Input.php` | Concluído |
| Input Group | `input-group.blade.php` | `InputGroup.php` | Concluído |
| Kbd | — | — | Pendente |
| Link | `link.blade.php` | `Link.php` | Concluído |
| Modal | `modal.blade.php` | — | Concluído |
| OAuth Buttons | `oauth-buttons.blade.php` | — | Concluído |
| Pagination | — | — | Pendente |
| Password Input | `password-input.blade.php` | — | Concluído |
| Progress | — | — | Pendente |
| Radio Group | — | — | Pendente |
| Rating | — | — | Pendente |
| Repeater | — | — | Pendente |
| Scrollable | — | — | Pendente |
| Select | `select.blade.php` | `Select.php` | Concluído |
| Skeleton | — | — | Pendente |
| Stepper | — | — | Pendente |
| Switch | — | — | Pendente |
| Tabs | — | — | Pendente |
| Textarea | — | — | Pendente |
| Theme Switch | — | — | Pendente |
| Toast | `toast.blade.php` | — | Concluído |
| Toggle | — | — | Pendente |
| Toggle Group | — | — | Pendente |
| Tooltip | — | — | Pendente |

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
