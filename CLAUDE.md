# CLAUDE.md

Instruções e convenções do projeto para uso do Claude Code. Leia este arquivo antes de qualquer tarefa.

---

## Visão geral do projeto

- **Nome:** ...
- **Descrição:** ...

---

## Stack

- **Laravel 13** + **Livewire 4.1** — reatividade server-side; sem Vue/React
- **Alpine.js 3.x** — interatividade leve no DOM (incluído automaticamente com Livewire)
- **Tailwind CSS 4.x** + **Metronic 9** — usa classes `kt-*` junto com Tailwind
- **Vite 8** — bundler de assets; entradas em `resources/css/app.css` e `resources/js/app.js`
- **MySQL** — sessions, cache e filas via banco de dados

---

## Docker / Laravel Sail

O projeto usa **Laravel Sail** para o ambiente de desenvolvimento via Docker.

```bash
# Subir o ambiente (em background)
./vendor/bin/sail up -d

# Parar o ambiente
./vendor/bin/sail down

# Alias recomendado (adicionar ao ~/.bashrc ou ~/.zshrc)
alias sail='./vendor/bin/sail'

# Acessar o shell do container
sail shell
```

> Todos os comandos abaixo (`artisan`, `composer`, `npm`) devem ser executados via `sail` quando o ambiente Docker estiver ativo.

---

## Comandos úteis

```bash
# Instalar dependências
sail composer install
sail npm install

# Desenvolvimento (rodar juntos)
sail artisan serve
sail npm run dev

# Build para produção
sail npm run build

# Banco de dados
sail artisan migrate
sail artisan db:seed
sail artisan migrate:fresh --seed

# Testes
sail artisan test --filter TestClassName
sail artisan test tests/Feature/SomeTest.php

# Limpar caches
sail artisan optimize:clear
```

---

## Email (desenvolvimento)

E-mails enviados pela aplicação são capturados pelo **Mailpit** (incluído no Sail).

Acesse em: **http://localhost:8025/**

---

## Arquitetura

### Rotas e páginas

Rotas ficam em `routes/web.php`. Todas requerem os middlewares `auth` + `verified`. Grupos principais:

- `/account/*` — perfil, segurança, aparência, notificações
- `/settings/*` — empresa, usuários, papéis, menus, integrações, parâmetros do sistema

As rotas resolvem para views Blade via namespace `pages::` (mapeado para `resources/views/pages/`).

### Sistema de layouts

Mais de dez variantes de layout admin ficam em `resources/views/layouts/admin/` (dark-sidebar, compact-sidebar, two-column-sidebar, horizontal-menu, etc.). Esses layouts são mantidos separados intencionalmente — não os consolide. Layouts de autenticação ficam em `resources/views/layouts/auth/`.

A sidebar ativa é controlada pelo `SidebarMenuComposer` (`app/View/Composers/SidebarMenuComposer.php`), que injeta `$menuTree` nas partials via View Composer registrado no `AppServiceProvider`.

### Sistema de menus

Menus são gerenciados via banco de dados (tabela `menus`) com hierarquia pai/filho. O `MenuService` (`app/Services/MenuService.php`) monta e cacheia a árvore (TTL de 5 minutos via facade `Cache`). Chame `MenuService::clearCache()` após qualquer alteração nos menus. O model `Menu` tem scopes (`active()`, `roots()`, `ordered()`) e helpers (`url()`, `isActive()`, `hasActiveChild()`).

### Componentes de UI

Componentes Blade reutilizáveis ficam em `resources/views/components/ui/` (Alert, Badge, Button, Input, InputGroup, Select, Breadcrumb, etc.) com seus equivalentes PHP em `app/View/Components/`. Use-os para todo novo trabalho de interface.

### Ícones

Dois sistemas de ícones estão em uso:

- **Keenicons** — `<i class="ki-filled ki-icon-name"></i>` (set de ícones do Metronic)
- **Lucide** — `@svg('lucide-icon-name')` (via `mallardduck/blade-lucide-icons`)

### Autenticação

Gerenciada pelo **Laravel Fortify** com actions customizadas em `app/Actions/Fortify/`. Views de auth são registradas no `FortifyServiceProvider`. Two-factor authentication está habilitado no model `User`.

---

## Convenções importantes

- Livewire usa `wire:navigate` para transições SPA-like entre páginas.
- O model `User` tem o helper `initials()` usado para exibição de avatar.
- `AppServiceProvider` força datas imutáveis com Carbon e bloqueia comandos Eloquent destrutivos fora de produção.
- Dark mode é ativado via classe CSS `.dark` — os tokens do Metronic usam CSS custom properties.

---

## Convenções de nomenclatura

| Contexto | Padrão | Exemplo |
|---|---|---|
| Classes PHP | PascalCase | `OrderService` |
| Métodos e variáveis PHP | camelCase | `calculateTotal()` |
| Tabelas do banco | snake_case plural | `order_items` |
| Rotas | kebab-case | `/meus-pedidos` |
| Arquivos Blade | kebab-case | `product-card.blade.php` |
| Variáveis JS | camelCase | `cartItemCount` |
| Classes CSS/SCSS | kebab-case (BEM) | `.product-card__title` |

---

## Padrão de commits

```
tipo(escopo): descrição curta no imperativo

Exemplos:
feat(auth): adiciona login com Google
fix(cart): corrige cálculo de desconto para itens fracionados
refactor(order): extrai lógica de frete para ShippingService
docs(claude): atualiza convenções de nomenclatura
```

Tipos aceitos: `feat`, `fix`, `refactor`, `style`, `docs`, `test`, `chore`

---

## Padrão de comentários

### Princípios gerais

- **Comente o _porquê_, não o _o quê_.** O código já descreve o que está sendo feito; o comentário deve explicar a intenção ou o contexto.
- **Comentário desatualizado é pior que nenhum.** Sempre atualize o comentário ao alterar o código correspondente.
- **Use marcadores padronizados** (`TODO`, `FIXME`, `HACK`, `NOTE`) para que possam ser localizados facilmente no projeto.
- **Evite comentar o óbvio.** Se o código é autoexplicativo, não adicione ruído.

### Marcadores especiais

```
// TODO: descrição do que precisa ser feito (e quando, se souber)
// FIXME: descrição do problema a corrigir
// HACK: explique o contorno temporário e por que ele existe
// NOTE: informação importante que o próximo desenvolvedor precisa saber
```

### PHP

**Linha única** — use `//` acima da linha ou inline ao final dela.

```php
// Valida se o usuário tem permissão antes de prosseguir
if (!$user->can('edit', $post)) {
    abort(403);
}

$total = $subtotal + $tax; // Inclui imposto calculado pelo TaxService
```

**Múltiplas linhas** — use `/* */` para blocos de explicação dentro de métodos.

```php
/*
 * Processa o pagamento via gateway externo.
 * Caso o gateway retorne erro, tenta o fallback
 * configurado em config/payment.php.
 */
public function processPayment(Order $order): bool
```

**DocBlock** — use `/** */` em classes, métodos públicos e propriedades públicas.

```php
/**
 * Calcula o valor total do pedido com descontos aplicados.
 *
 * @param  Order   $order    Pedido a ser calculado
 * @param  float   $discount Percentual de desconto (0–100)
 * @return float             Valor final após desconto
 *
 * @throws InvalidArgumentException Se o desconto for negativo
 */
public function calculateTotal(Order $order, float $discount): float
```

| Situação | Sintaxe |
|---|---|
| Classe, método ou propriedade pública | `/** DocBlock */` |
| Bloco explicativo dentro do código | `/* bloco */` |
| Linha única ou inline | `// linha` |

### Blade

Prefira sempre `{{-- --}}`. Esse comentário não aparece no HTML renderizado, evitando vazar a estrutura interna para quem inspeciona o código no navegador.

```blade
{{-- Seção de cabeçalho do dashboard --}}
<header>...</header>

{{--
    Lista de produtos paginada.
    Requer a variável $products (LengthAwarePaginator)
    passada pelo ProductController@index.
--}}
@foreach ($products as $product)
```

Use `<!-- -->` apenas para âncoras ou regiões que precisem ser visíveis no DevTools.

```blade
<!-- #region: Sidebar -->
<aside>...</aside>
<!-- #endregion -->
```

| Situação | Sintaxe |
|---|---|
| Padrão (não aparece no HTML) | `{{-- comentário --}}` |
| Âncora/região visível no DevTools | `<!-- comentário -->` |

### JavaScript / TypeScript

**Linha única** — use `//` acima da linha ou inline ao final dela.

```js
// Debounce de 300ms para não sobrecarregar a API de busca
const handleSearch = debounce(fetchResults, 300)

const TAX_RATE = 0.12 // 12% — alíquota federal vigente
```

**Múltiplas linhas** — use `/* */` para blocos de explicação.

```js
/*
 * Normaliza o payload antes de enviar ao backend.
 * Remove campos nulos e converte datas para ISO 8601.
 */
function normalizePayload(data) {
```

**JSDoc** — use `/** */` em funções exportadas e utilitários compartilhados.

```js
/**
 * Formata um valor monetário para o locale pt-BR.
 *
 * @param {number} value            - Valor numérico a formatar
 * @param {string} [currency='BRL'] - Código da moeda
 * @returns {string} Valor formatado (ex: "R$ 1.234,56")
 */
export function formatCurrency(value, currency = 'BRL') {
```

| Situação | Sintaxe |
|---|---|
| Funções e tipos exportados | `/** JSDoc */` |
| Bloco explicativo dentro do código | `/* bloco */` |
| Linha única ou inline | `// linha` |

### CSS

```css
/* Limpa float dos elementos filhos */
.container::after {
    content: '';
    display: block;
    clear: both;
}

/* ==========================================================================
   Componente: Card de Produto
   ========================================================================== */

.product-card { ... }

/* --------------------------------------------------------------------------
   Variante: card destacado
   -------------------------------------------------------------------------- */

.product-card--featured { ... }
```

| Situação | Sintaxe |
|---|---|
| Seção principal do arquivo | `/* ===...=== */` |
| Subseção / variante | `/* ---...--- */` |
| Linha única ou inline | `/* linha */` |

### SCSS

| Sintaxe | Compilado no CSS final? | Quando usar |
|---|---|---|
| `// linha` | Não | Notas internas, variáveis, mixins, imports |
| `/* linha */` | Sim | Documentação pública, licenças, seções |

```scss
// Variáveis internas — não aparecem no CSS compilado
$card-padding: 1.25rem;
$card-radius: 8px;

/* ==========================================================================
   Componente: Card de Produto — aparece no CSS compilado
   ========================================================================== */

.product-card {
    padding: $card-padding; // usa variável interna
    border-radius: $card-radius;
}
```
