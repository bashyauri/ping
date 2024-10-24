<?php

namespace Database\Factories;

use App\Models\Check;
use App\Models\Credential;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Check>
 */
final class CheckFactory extends Factory
{
    protected $model = Check::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'path' => $this->faker->url(),
            'method' => 'GET',
            'body' => null,
            'headers' => null,
            'parameters' => null,
            'credential_id' => $this->faker->boolean() ? Credential::factory() : null,
            'service_id' => Service::factory(),
        ];
    }
}
