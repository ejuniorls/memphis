<?php

namespace Database\Factories;

use App\Enums\ContactType;
use App\Enums\IntegrationSystem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'                       => fake()->name(),
            'email'                      => fake()->unique()->safeEmail(),
            'email_verified_at'          => now(),
            'password'                   => static::$password ??= Hash::make('password'),
            'remember_token'             => Str::random(10),
            'two_factor_secret'          => null,
            'two_factor_recovery_codes'  => null,
            'two_factor_confirmed_at'    => null,

            // Campos de perfil
            'avatar'         => null,
            'bio'            => fake()->optional(0.7)->sentence(12),
            'job_title'      => fake()->optional(0.8)->jobTitle(),
            'company'        => fake()->optional(0.8)->company(),
            'location'       => fake()->optional(0.6)->city() . ', ' . fake()->optional(0.6)->stateAbbr(),
            'website'        => fake()->optional(0.4)->url(),
            'linkedin'       => fake()->optional(0.5)->userName(),
            'github'         => fake()->optional(0.4)->userName(),
            'twitter'        => fake()->optional(0.3)->userName(),
            'instagram'      => fake()->optional(0.3)->userName(),
            'profile_public' => fake()->boolean(80),
            'show_email'     => fake()->boolean(30),
            'show_phone'     => fake()->boolean(20),
        ];
    }

    /**
     * Usuário administrador/fixo (ex: seed inicial).
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name'              => 'Administrador',
            'email'             => 'admin@example.com',
            'email_verified_at' => now(),
            'job_title'         => 'Administrador do Sistema',
            'profile_public'    => true,
            'show_email'        => true,
        ]);
    }

    /**
     * E-mail ainda não verificado.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Perfil completo (todos os campos preenchidos).
     */
    public function withFullProfile(): static
    {
        return $this->state(fn (array $attributes) => [
            'bio'            => fake()->paragraph(2),
            'job_title'      => fake()->jobTitle(),
            'company'        => fake()->company(),
            'location'       => fake()->city() . ', ' . fake()->stateAbbr(),
            'website'        => fake()->url(),
            'linkedin'       => fake()->userName(),
            'github'         => fake()->userName(),
            'twitter'        => fake()->userName(),
            'instagram'      => fake()->userName(),
            'profile_public' => true,
            'show_email'     => true,
            'show_phone'     => true,
        ]);
    }

    /**
     * Two-factor authentication habilitado.
     */
    public function withTwoFactor(): static
    {
        return $this->state(fn (array $attributes) => [
            'two_factor_secret'          => encrypt('secret'),
            'two_factor_recovery_codes'  => encrypt(json_encode(['recovery-code-1'])),
            'two_factor_confirmed_at'    => now(),
        ]);
    }

    /**
     * Configura contatos de telefone após criar o usuário.
     */
    public function withContacts(int $count = 2): static
    {
        return $this->afterCreating(function (User $user) use ($count) {
            $types = ContactType::cases();

            foreach (range(1, $count) as $i) {
                $user->contacts()->create([
                    'type'       => fake()->randomElement($types)->value,
                    'number'     => fake()->phoneNumber(),
                    'is_primary' => $i === 1,
                ]);
            }
        });
    }

    /**
     * Configura integração com sistema externo após criar o usuário.
     */
    public function withIntegration(IntegrationSystem $system = IntegrationSystem::Protheus): static
    {
        return $this->afterCreating(function (User $user) use ($system) {
            $user->integrations()->create([
                'system'      => $system->value,
                'external_id' => strtoupper(fake()->bothify('??####')),
                'metadata'    => [
                    'filial'   => fake()->numerify('##'),
                    'empresa'  => fake()->numerify('##'),
                    'ambiente' => fake()->randomElement(['producao', 'homologacao']),
                ],
                'active'      => true,
            ]);
        });
    }
}
