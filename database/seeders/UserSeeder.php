<?php

namespace Database\Seeders;

use App\Enums\ContactType;
use App\Enums\IntegrationSystem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ----------------------------------------------------------------
        // 1. Usuário administrador fixo
        // ----------------------------------------------------------------
        $admin = User::factory()->admin()->create([
            'password' => Hash::make('password'),
        ]);

        $admin->contacts()->createMany([
            [
                'type' => ContactType::Commercial->value,
                'number' => '(11) 99999-0001',
                'is_primary' => true,
            ],
            [
                'type' => ContactType::WhatsApp->value,
                'number' => '(11) 99999-0002',
                'is_primary' => false,
            ],
        ]);

        $admin->integrations()->create([
            'system' => IntegrationSystem::AD->value,
            'external_id' => 'admin.sistema',
            'metadata' => ['ou' => 'TI', 'domain' => 'example.local'],
            'active' => true,
        ]);

        // ----------------------------------------------------------------
        // 2. Usuário de teste (compatível com o DatabaseSeeder original)
        // ----------------------------------------------------------------
        $test = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $test->contacts()->create([
            'type' => ContactType::Personal->value,
            'number' => '(11) 98888-0001',
            'is_primary' => true,
        ]);

        // ----------------------------------------------------------------
        // 3. Usuários de demonstração com perfil completo
        // ----------------------------------------------------------------
        User::factory()
            ->count(5)
            ->withFullProfile()
            ->withContacts(2)
            ->withIntegration(IntegrationSystem::Protheus)
            ->create();

        // ----------------------------------------------------------------
        // 4. Usuários comuns com dados variados
        // ----------------------------------------------------------------
        User::factory()
            ->count(10)
            ->withContacts(1)
            ->create();

        // ----------------------------------------------------------------
        // 5. Usuários sem e-mail verificado
        // ----------------------------------------------------------------
        User::factory()
            ->count(3)
            ->unverified()
            ->create();

        // ----------------------------------------------------------------
        // 6. Usuários com integração SAP
        // ----------------------------------------------------------------
        User::factory()
            ->count(3)
            ->withIntegration(IntegrationSystem::SAP)
            ->create();

        $this->command->info('UserSeeder concluído:');
        $this->command->info('  • 1 admin (admin@example.com / password)');
        $this->command->info('  • 1 test  (test@example.com / password)');
        $this->command->info('  • 5 usuários com perfil completo + Protheus');
        $this->command->info('  • 10 usuários comuns');
        $this->command->info('  • 3 usuários sem e-mail verificado');
        $this->command->info('  • 3 usuários com integração SAP');
    }
}
