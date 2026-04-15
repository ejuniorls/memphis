# Memphis — Admin Panel for ERP

Memphis is the admin interface for a future ERP system, built from the ground up with a modern Laravel stack. It is currently in early development, focusing on establishing the foundation: layout system, base UI components, internationalization, and a living documentation layer.

---

## Overview

Memphis is a full redesign of an existing ERP's admin panel, replacing legacy tooling with a clean, maintainable architecture. The project uses the Metronic 9 theme as a design base, adapted through Tailwind CSS and integrated deeply with Laravel Livewire for reactive server-side components.

---

## Tech Stack

| Layer | Technology                |
|---|---------------------------|
| Backend | Laravel 13.x              |
| Frontend Reactivity | Livewire 4.x              |
| UI Theme | Metronic 9 (Tailwind CSS) |
| Interactivity | Alpine.js 3.x             |
| Build Tool | Vite 6.x                  |
| Database | MySQL                     |
| Node.js | Latest LTS                |

---

## Project Structure

```
resources/
.
├── css
│   └── app.css
├── js
│   ├── app.js
│   └── bootstrap.js
└── views
    ├── components
    │   ├── app-logo-icon.blade.php
    │   ├── app-logo.blade.php
    │   ├── auth-header.blade.php
    │   ├── auth-session-status.blade.php
    │   ├── desktop-user-menu.blade.php
    │   └── placeholder-pattern.blade.php
    ├── dashboard.blade.php
    ├── flux
    │   ├── icon
    │   │   ├── book-open-text.blade.php
    │   │   ├── chevrons-up-down.blade.php
    │   │   ├── folder-git-2.blade.php
    │   │   └── layout-grid.blade.php
    │   └── navlist
    │       └── group.blade.php
    ├── layouts
    │   ├── admin
    │   │   ├── advanced-mega-menu
    │   │   │   ├── footer.blade.php
    │   │   │   ├── header.blade.php
    │   │   │   ├── index.blade.php
    │   │   │   ├── mega-menu.blade.php
    │   │   │   └── toolbar.blade.php
    │   │   ├── advanced-mega-menu.blade.php
    │   │   ├── compact-sidebar
    │   │   │   ├── footer.blade.php
    │   │   │   ├── header.blade.php
    │   │   │   ├── index.blade.php
    │   │   │   ├── navbar.blade.php
    │   │   │   └── sidebar.blade.php
    │   │   ├── compact-sidebar.blade.php
    │   │   ├── dark-sidebar
    │   │   │   ├── footer.blade.php
    │   │   │   ├── header.blade.php
    │   │   │   ├── index.blade.php
    │   │   │   ├── partials
    │   │   │   │   ├── notification.blade.php
    │   │   │   │   ├── sidebar-menu.blade.php
    │   │   │   │   └── user-dropdown.blade.php
    │   │   │   ├── sidebar.blade.php
    │   │   │   └── toolbar.blade.php
    │   │   ├── dark-sidebar.blade.php
    │   │   ├── default
    │   │   │   ├── footer.blade.php
    │   │   │   ├── header.blade.php
    │   │   │   ├── index.blade.php
    │   │   │   ├── profile.blade.php
    │   │   │   ├── settings.blade.php
    │   │   │   ├── sidebar.blade.php
    │   │   │   └── users.blade.php
    │   │   ├── default.blade.php
    │   │   ├── dropdown-menu
    │   │   │   ├── footer.blade.php
    │   │   │   ├── header.blade.php
    │   │   │   ├── index.blade.php
    │   │   │   ├── partials
    │   │   │   │   ├── sidebar-footer.blade.php
    │   │   │   │   ├── sidebar-menu.blade.php
    │   │   │   │   └── user-dropdown.blade.php
    │   │   │   ├── sidebar.blade.php
    │   │   │   └── toolbar.blade.php
    │   │   ├── dropdown-menu.blade.php
    │   │   ├── dual-row-header
    │   │   │   ├── footer.blade.php
    │   │   │   ├── header.blade.php
    │   │   │   ├── index.blade.php
    │   │   │   ├── navbar.blade.php
    │   │   │   ├── sidebar.blade.php
    │   │   │   └── toolbar.blade.php
    │   │   ├── dual-row-header.blade.php
    │   │   ├── extended-header
    │   │   │   ├── footer.blade.php
    │   │   │   ├── header.blade.php
    │   │   │   ├── index.blade.php
    │   │   │   ├── navbar.blade.php
    │   │   │   ├── partials
    │   │   │   │   ├── notification.blade.php
    │   │   │   │   └── user-dropdown.blade.php
    │   │   │   ├── sidebar.blade.php
    │   │   │   └── toolbar.blade.php
    │   │   ├── extended-header.blade.php
    │   │   ├── horizontal-menu
    │   │   │   ├── footer.blade.php
    │   │   │   ├── header.blade.php
    │   │   │   ├── index.blade.php
    │   │   │   ├── navbar.blade.php
    │   │   │   ├── profile.blade.php
    │   │   │   ├── settings.blade.php
    │   │   │   ├── toolbar.blade.php
    │   │   │   └── users.blade.php
    │   │   ├── horizontal-menu.blade.php
    │   │   ├── multiple-menus
    │   │   │   ├── footer.blade.php
    │   │   │   ├── header.blade.php
    │   │   │   ├── index.blade.php
    │   │   │   ├── partials
    │   │   │   │   └── sidebar-menu.blade.php
    │   │   │   ├── sidebar.blade.php
    │   │   │   └── toolbar.blade.php
    │   │   ├── multiple-menus.blade.php
    │   │   ├── two-column-sidebar
    │   │   │   ├── footer.blade.php
    │   │   │   ├── header.blade.php
    │   │   │   ├── navbar.blade.php
    │   │   │   ├── sidebar.blade.php
    │   │   │   └── toolbar.blade.php
    │   │   └── two-column-sidebar.blade.php
    │   ├── app
    │   │   ├── header.blade.php
    │   │   └── sidebar.blade.php
    │   ├── app.blade.php
    │   ├── auth
    │   │   ├── branded.blade.php
    │   │   ├── card.blade.php
    │   │   ├── simple.blade.php
    │   │   └── split.blade.php
    │   └── auth.blade.php
    ├── pages
    │   ├── auth
    │   │   ├── confirm-password.blade.php
    │   │   ├── forgot-password.blade.php
    │   │   ├── login.blade.php
    │   │   ├── register.blade.php
    │   │   ├── reset-password.blade.php
    │   │   ├── two-factor-challenge.blade.php
    │   │   └── verify-email.blade.php
    │   └── settings
    │       ├── layout.blade.php
    │       ├── two-factor
    │       │   └── ⚡recovery-codes.blade.php
    │       ├── ⚡appearance.blade.php
    │       ├── ⚡delete-user-form.blade.php
    │       ├── ⚡delete-user-modal.blade.php
    │       ├── ⚡profile.blade.php
    │       ├── ⚡security.blade.php
    │       └── ⚡two-factor-setup-modal.blade.php
    ├── partials
    │   ├── head.blade.php
    │   ├── logo.blade.php
    │   ├── mega-menu.blade.php
    │   ├── scripts.blade.php
    │   ├── settings-heading.blade.php
    │   ├── theme-toggle.blade.php
    │   ├── topbar-apps.blade.php
    │   ├── topbar-chat.blade.php
    │   ├── topbar-notification-dropdown.blade.php
    │   ├── topbar-search-modal.blade.php
    │   └── topbar-user-dropdown.blade.php
    └── welcome.blade.php
```

---

## Features

### Completed

#### Layouts
- **Admin layout** — full sidebar-based admin shell
- **Auth layout** — clean authentication pages shell

#### Authentication Pages
- Login, Register, Password Reset (and related pages)

#### Internationalization
- Language switching feature with `lang` support
- Currently applied to core layout and auth pages
- Pending: translation of remaining pages and components

#### UI Components (with documentation and examples)
- Alert
- Badge
- Button
- Input
- Input Group
- Select

#### Documentation
- Live examples for all completed components
- Known corrections pending in current docs

---

### Livewire PHP Classes (Pending)

The following component PHP classes still need to be created:

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

### Components Roadmap

The following UI components are planned. Items already implemented are marked.

| Component | Status  |
|---|---------|
| Accordion | Pending |
| Alert | Done    |
| Avatar | Pending |
| Badge | Done    |
| Breadcrumb | Pending |
| Button | Done    |
| Card | Pending |
| Checkbox | Pending |
| Collapse | Pending |
| Datatable | Pending |
| Dismiss | Pending |
| Drawer | Pending |
| Dropdown | Pending |
| Image | Pending |
| Input | Done    |
| Input Group | Done    |
| Input Update | Pending |
| Kbd | Pending |
| Link | Pending |
| Modal | Pending |
| Pagination | Pending |
| Progress | Pending |
| Radio Group | Pending |
| Rating | Pending |
| Reparent | Pending |
| Repeater | Pending |
| Scrollable | Pending |
| Scrollspy Update | Pending |
| Scrollto | Pending |
| Select | Done    |
| Separator | Pending |
| Skeleton | Pending |
| Stepper | Pending |
| Sticky | Pending |
| Switch | Pending |
| Tabs | Pending |
| Textarea | Pending |
| Theme Switch | Pending |
| Toast | Pending |
| Toggle | Pending |
| Toggle Group | Pending |
| Toggle Password | Pending |
| Tooltip | Pending |

---

### Internationalization Roadmap

- [x] Language switching mechanism
- [x] Auth pages translated
- [ ] Admin layout translated
- [ ] All UI components translated
- [ ] All remaining pages translated

---

### Planned Features

- **Default font switcher** — user/system preference to change the default font family used across the admin panel

---

## Styling System

- **Tailwind CSS 4.x** with custom Metronic utilities
- **Custom CSS classes** using `kt-*` prefix
- **Dark mode** with theme switching support
- **Responsive design** using a mobile-first approach
- **CSS custom properties** matching the Metronic design system

---

## Getting Started

### Development

```bash
# Install dependencies
npm install
composer install

# Start development server
php artisan serve
npm run dev
```

### Production

```bash
npm run build
```

### Routes

| Path | Description |
|---|---|
| `/demo1` | Sidebar-based admin layout (Demo1) |
| `/demo2` | Vertical layout (Demo2) |

---

## Architecture Notes

### Layout System
- **Demo1** — traditional sidebar-based admin shell
- **Demo2** — modern vertical layout shell
- **Shared partials** — head, scripts, theme-mode reused across both layouts

### Technology Decisions

- **Livewire over Vue/React** — keeps the stack Laravel-native and reduces JavaScript complexity
- **Tailwind CSS** — utility-first, aligns naturally with Metronic's design system
- **Alpine.js** — lightweight interactivity layer without a full JS framework
- **Vite** — fast modern build tool with hot reloading during development

### Structure Philosophy
- Symfony-inspired view folder structure for familiarity and consistency
- Demo1 and Demo2 are kept fully separate to avoid layout coupling
- Shared components reduce duplication across layouts
- Documentation lives alongside components as first-class deliverables

---

## Contributing

When adding new components or features:

1. Follow the established directory structure
2. Use proper Blade syntax with `{{-- comments --}}`
3. Use `wire:model` for Livewire form bindings
4. Maintain responsive, mobile-first design
5. Add documentation with working examples for every new component
6. Ensure new components support internationalization from the start

---
## Artisan Commands
1. php artisan ai:translate sign --from=en --to=pt_BR

---

## License

Memphis admin code is proprietary, developed as part of an internal ERP system. The Metronic theme is used under its commercial license.
