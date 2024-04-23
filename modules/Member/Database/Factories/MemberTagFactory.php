<?php

namespace Modules\Member\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Member\Models\Member;
use Modules\Member\Models\MemberTag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Member\Models\Member>
 */
class MemberTagFactory extends Factory
{
    protected $model = MemberTag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->word,
            'member_id' => Member::factory(),
        ];
    }
}
