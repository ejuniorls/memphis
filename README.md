# Memphis — Admin Panel for ERP

Memphis is the admin interface for a future ERP system, built from the ground up with a modern Laravel stack. It is currently in early development, focusing on establishing the foundation: layout system, base UI components, internationalization, and a living documentation layer.

---

## Overview

Memphis is a full redesign of an existing ERP's admin panel, replacing legacy tooling with a clean, maintainable architecture. The project uses the Metronic 9 theme as a design base, adapted through Tailwind CSS and integrated deeply with Laravel Livewire for reactive server-side components.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 12.x |
| Frontend Reactivity | Livewire 3.x |
| UI Theme | Metronic 9 (Tailwind CSS) |
| Interactivity | Alpine.js 3.x |
| Build Tool | Vite 6.x |
| Database | MySQL |
| Node.js | Latest LTS |

---

## Project Structure

```
resources/
├── css/
│   └── app.css                  # Tailwind + Metronic custom styles
├── js/
│   └── app.js                   # Alpine.js + Livewire integration
└── views/
    ├── layouts/
    │   ├── partials/
    │   │   ├── head.blade.php
    │   │   ├── scripts.blade.php
    │   │   └── theme-mode.blade.php
    │   ├── demo1/
    │   │   ├── base.blade.php
    │   │   └── partials/
    │   │       ├── header.blade.php
    │   │       ├── sidebar.blade.php
    │   │       ├── footer.blade.php
    │   │       └── mega-menu.blade.php
    │   └── demo2/
    │       ├── base.blade.php
    │       └── partials/
    │           ├── header.blade.php
    │           └── footer.blade.php
    ├── demo1/
    │   └── index.blade.php
    ├── demo2/
    │   └── index.blade.php
    └── livewire/
        ├── demo1/
        │   ├── navigation-menu.blade.php
        │   ├── sidebar-toggle.blade.php
        │   └── user-dropdown.blade.php
        ├── demo2/
        │   ├── navigation-menu.blade.php
        │   ├── balance-widget.blade.php
        │   └── user-dropdown.blade.php
        └── shared/
            ├── theme-mode.blade.php
            ├── search-box.blade.php
            └── notification-dropdown.blade.php
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

### 🔧 Livewire PHP Classes (Pending)

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
