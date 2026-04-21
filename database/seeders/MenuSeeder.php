<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::truncate();

        // ======================================================================
        // Dashboard (sem filhos — clica e navega direto)
        // ======================================================================
        Menu::create([
            'label'             => 'Dashboard',
            'icon'              => 'ki-filled ki-home-3',
            'route'             => 'dashboard',
            'is_route'          => true,
            'parent_id'         => null,
            'order'             => 1,
            'active'            => true,
            'section'           => null,
            'is_section_header' => false,
        ]);

        // ======================================================================
        // Financeiro (clica → vai para primeira rota + abre submenus)
        // ======================================================================
        $financeiro = Menu::create([
            'label'             => 'Financeiro',
            'icon'              => 'ki-filled ki-dollar',
            'route'             => '#',
            'is_route'          => false,
            'parent_id'         => null,
            'order'             => 2,
            'active'            => true,
            'section'           => null,
            'is_section_header' => false,
        ]);

        Menu::create(['label' => 'Contas a Pagar',   'icon' => null, 'route' => '#', 'is_route' => false, 'parent_id' => $financeiro->id, 'order' => 1, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Contas a Receber', 'icon' => null, 'route' => '#', 'is_route' => false, 'parent_id' => $financeiro->id, 'order' => 2, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Fluxo de Caixa',   'icon' => null, 'route' => '#', 'is_route' => false, 'parent_id' => $financeiro->id, 'order' => 3, 'active' => true, 'section' => null, 'is_section_header' => false]);

        // ======================================================================
        // Estoque
        // ======================================================================
        $estoque = Menu::create([
            'label'             => 'Estoque',
            'icon'              => 'ki-filled ki-abstract-26',
            'route'             => '#',
            'is_route'          => false,
            'parent_id'         => null,
            'order'             => 3,
            'active'            => true,
            'section'           => null,
            'is_section_header' => false,
        ]);

        Menu::create(['label' => 'Produtos',     'icon' => null, 'route' => '#', 'is_route' => false, 'parent_id' => $estoque->id, 'order' => 1, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Categorias',   'icon' => null, 'route' => '#', 'is_route' => false, 'parent_id' => $estoque->id, 'order' => 2, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Movimentação', 'icon' => null, 'route' => '#', 'is_route' => false, 'parent_id' => $estoque->id, 'order' => 3, 'active' => true, 'section' => null, 'is_section_header' => false]);

        // ======================================================================
        // Vendas
        // ======================================================================
        $vendas = Menu::create([
            'label'             => 'Vendas',
            'icon'              => 'ki-filled ki-basket',
            'route'             => '#',
            'is_route'          => false,
            'parent_id'         => null,
            'order'             => 4,
            'active'            => true,
            'section'           => null,
            'is_section_header' => false,
        ]);

        Menu::create(['label' => 'Pedidos',    'icon' => null, 'route' => '#', 'is_route' => false, 'parent_id' => $vendas->id, 'order' => 1, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Clientes',   'icon' => null, 'route' => '#', 'is_route' => false, 'parent_id' => $vendas->id, 'order' => 2, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Relatórios', 'icon' => null, 'route' => '#', 'is_route' => false, 'parent_id' => $vendas->id, 'order' => 3, 'active' => true, 'section' => null, 'is_section_header' => false]);

        // ======================================================================
        // Minha Conta (clica → vai para account/profile + abre submenus)
        // ======================================================================
        $account = Menu::create([
            'label'             => 'Minha Conta',
            'icon'              => 'ki-filled ki-profile-circle',
            'route'             => 'account.profile',
            'is_route'          => true,
            'parent_id'         => null,
            'order'             => 10,
            'active'            => true,
            'section'           => null,
            'is_section_header' => false,
        ]);

        Menu::create(['label' => 'Perfil',       'icon' => null, 'route' => 'account.profile',       'is_route' => true, 'parent_id' => $account->id, 'order' => 1, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Segurança',    'icon' => null, 'route' => 'account.security',      'is_route' => true, 'parent_id' => $account->id, 'order' => 2, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Aparência',    'icon' => null, 'route' => 'account.appearance',    'is_route' => true, 'parent_id' => $account->id, 'order' => 3, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Notificações', 'icon' => null, 'route' => 'account.notifications', 'is_route' => true, 'parent_id' => $account->id, 'order' => 4, 'active' => true, 'section' => null, 'is_section_header' => false]);

        // ======================================================================
        // Settings (clica → vai para settings/company + abre submenus)
        // ======================================================================
        $settings = Menu::create([
            'label'             => 'Settings',
            'icon'              => 'ki-filled ki-setting-2',
            'route'             => 'settings.company.index',
            'is_route'          => true,
            'parent_id'         => null,
            'order'             => 11,
            'active'            => true,
            'section'           => null,
            'is_section_header' => false,
        ]);

        // Empresa
        $empresa = Menu::create([
            'label'             => 'Empresa',
            'icon'              => null,
            'route'             => 'settings.company.index',
            'is_route'          => true,
            'parent_id'         => $settings->id,
            'order'             => 1,
            'active'            => true,
            'section'           => null,
            'is_section_header' => false,
        ]);
        Menu::create(['label' => 'Dados Gerais',  'icon' => null, 'route' => 'settings.company.index',   'is_route' => true, 'parent_id' => $empresa->id, 'order' => 1, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Dados Fiscais', 'icon' => null, 'route' => 'settings.company.fiscal',  'is_route' => true, 'parent_id' => $empresa->id, 'order' => 2, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Contatos',      'icon' => null, 'route' => 'settings.company.contact', 'is_route' => true, 'parent_id' => $empresa->id, 'order' => 3, 'active' => true, 'section' => null, 'is_section_header' => false]);

        // Usuários
        $usuarios = Menu::create([
            'label'             => 'Usuários',
            'icon'              => null,
            'route'             => 'settings.users.index',
            'is_route'          => true,
            'parent_id'         => $settings->id,
            'order'             => 2,
            'active'            => true,
            'section'           => null,
            'is_section_header' => false,
        ]);
        Menu::create(['label' => 'Listagem', 'icon' => null, 'route' => 'settings.users.index',  'is_route' => true, 'parent_id' => $usuarios->id, 'order' => 1, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Novo',     'icon' => null, 'route' => 'settings.users.create', 'is_route' => true, 'parent_id' => $usuarios->id, 'order' => 2, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Convidar', 'icon' => null, 'route' => 'settings.users.invite', 'is_route' => true, 'parent_id' => $usuarios->id, 'order' => 3, 'active' => true, 'section' => null, 'is_section_header' => false]);

        // Papéis & Permissões
        $roles = Menu::create([
            'label'             => 'Papéis & Permissões',
            'icon'              => null,
            'route'             => 'settings.roles.index',
            'is_route'          => true,
            'parent_id'         => $settings->id,
            'order'             => 3,
            'active'            => true,
            'section'           => null,
            'is_section_header' => false,
        ]);
        Menu::create(['label' => 'Papéis',     'icon' => null, 'route' => 'settings.roles.index',  'is_route' => true, 'parent_id' => $roles->id, 'order' => 1, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Novo Papel', 'icon' => null, 'route' => 'settings.roles.create', 'is_route' => true, 'parent_id' => $roles->id, 'order' => 2, 'active' => true, 'section' => null, 'is_section_header' => false]);

        // Menus
        $menus = Menu::create([
            'label'             => 'Menus',
            'icon'              => null,
            'route'             => 'settings.menus.index',
            'is_route'          => true,
            'parent_id'         => $settings->id,
            'order'             => 4,
            'active'            => true,
            'section'           => null,
            'is_section_header' => false,
        ]);
        Menu::create(['label' => 'Listagem', 'icon' => null, 'route' => 'settings.menus.index',  'is_route' => true, 'parent_id' => $menus->id, 'order' => 1, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Novo',     'icon' => null, 'route' => 'settings.menus.create', 'is_route' => true, 'parent_id' => $menus->id, 'order' => 2, 'active' => true, 'section' => null, 'is_section_header' => false]);

        // Integrações
        $integracoes = Menu::create([
            'label'             => 'Integrações',
            'icon'              => null,
            'route'             => 'settings.integrations.index',
            'is_route'          => true,
            'parent_id'         => $settings->id,
            'order'             => 5,
            'active'            => true,
            'section'           => null,
            'is_section_header' => false,
        ]);
        Menu::create(['label' => 'Listagem', 'icon' => null, 'route' => 'settings.integrations.index',  'is_route' => true, 'parent_id' => $integracoes->id, 'order' => 1, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Nova',     'icon' => null, 'route' => 'settings.integrations.create', 'is_route' => true, 'parent_id' => $integracoes->id, 'order' => 2, 'active' => true, 'section' => null, 'is_section_header' => false]);

        // Sistema
        $sistema = Menu::create([
            'label'             => 'Sistema',
            'icon'              => null,
            'route'             => 'settings.system.params',
            'is_route'          => true,
            'parent_id'         => $settings->id,
            'order'             => 6,
            'active'            => true,
            'section'           => null,
            'is_section_header' => false,
        ]);
        Menu::create(['label' => 'Parâmetros',       'icon' => null, 'route' => 'settings.system.params',    'is_route' => true, 'parent_id' => $sistema->id, 'order' => 1, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Backup',           'icon' => null, 'route' => 'settings.system.backup',    'is_route' => true, 'parent_id' => $sistema->id, 'order' => 2, 'active' => true, 'section' => null, 'is_section_header' => false]);
        Menu::create(['label' => 'Log de Auditoria', 'icon' => null, 'route' => 'settings.system.audit-log', 'is_route' => true, 'parent_id' => $sistema->id, 'order' => 3, 'active' => true, 'section' => null, 'is_section_header' => false]);
    }
}
