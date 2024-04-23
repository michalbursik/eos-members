<?php

namespace Modules\Member\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Member\Models\Member;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Member\Models\Member>
 */
class MemberFactory extends Factory
{
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'birthdate' => $this->faker->date,
        ];
    }
}
