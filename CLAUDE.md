# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Docker / Laravel Sail

O projeto usa **Laravel Sail** para o ambiente de desenvolvimento via Docker.

```bash
# Subir o ambiente (em background)
./vendor/bin/sail up -d

# Parar o ambiente
./vendor/bin/sail down

# Alias recomendado (adicionar ao ~/.bashrc ou ~/.zshrc)
alias sail='./vendor/bin/sail'

# Instalar dependências dentro do container
sail composer install
sail npm install

# Acessar o shell do container
sail shell
```

> Todos os comandos abaixo (`artisan`, `composer`, `npm`) devem ser executados via `sail` quando o ambiente Docker estiver ativo.

## Commands

```bash
# Install dependencies
sail composer install
sail npm install

# Development (run both together)
sail artisan serve
sail npm run dev

# Build for production
sail npm run build

# Database
sail artisan migrate
sail artisan db:seed
sail artisan migrate:fresh --seed

# Run a single test
sail artisan test --filter TestClassName
sail artisan test tests/Feature/SomeTest.php

# Clear caches
sail artisan optimize:clear
```

## Stack

- **Laravel 13** + **Livewire 4.1** — server-side reactivity; no Vue/React
- **Alpine.js 3.x** — lightweight DOM interactivity (auto-included with Livewire)
- **Tailwind CSS 4.x** + **Metronic 9** design system — uses `kt-*` utility classes alongside Tailwind
- **Vite 8** — asset bundler; entry points are `resources/css/app.css` and `resources/js/app.js`
- **MySQL** with database-backed sessions, cache, and queues

## Architecture

### Routing & Pages

Routes are in `routes/web.php`. All routes require `auth` + `verified` middleware. Route groups:
- `/account/*` — user profile, security, appearance, notifications
- `/settings/*` — company info, users, roles, menus, integrations, system params

Routes resolve to Blade views via `pages::` namespace (maps to `resources/views/pages/`).

### Layout System

Ten+ admin layout variants live in `resources/views/layouts/admin/` (dark-sidebar, compact-sidebar, two-column-sidebar, horizontal-menu, etc.). These are intentionally kept separate — do not consolidate them. Auth layouts are in `resources/views/layouts/auth/`.

The active sidebar is driven by `SidebarMenuComposer` (`app/View/Composers/SidebarMenuComposer.php`), which injects `$menuTree` into sidebar partials via a View Composer registered in `AppServiceProvider`.

### Menu System

Menus are database-driven (`menus` table) with a parent/child hierarchy. `MenuService` (`app/Services/MenuService.php`) builds and caches the tree (5-minute TTL via the `Cache` facade). Call `MenuService::clearCache()` after any menu update. The `Menu` model has scopes (`active()`, `roots()`, `ordered()`) and helpers (`url()`, `isActive()`, `hasActiveChild()`).

### UI Components

Reusable Blade components live in `resources/views/components/ui/` (Alert, Badge, Button, Input, InputGroup, Select, Breadcrumb, etc.) and their PHP counterparts in `app/View/Components/`. Use these for all new UI work.

### Icons

Two icon systems are in use:
- **Keenicons** — `<i class="ki-filled ki-icon-name"></i>` (Metronic's icon set)
- **Lucide** — `@svg('lucide-icon-name')` (via `mallardduck/blade-lucide-icons`)

### Authentication

Handled by **Laravel Fortify** with custom actions in `app/Actions/Fortify/`. Custom auth views are registered in `FortifyServiceProvider`. Two-factor authentication is enabled on the `User` model.

## Key Conventions

- Livewire components use `wire:navigate` for SPA-like page transitions.
- The `User` model has an `initials()` helper used for avatar display.
- `AppServiceProvider` enforces Carbon immutable dates and prevents destructive Eloquent commands in non-production.
- Dark mode is toggled via a `.dark` CSS class — Metronic design tokens use CSS custom properties.
