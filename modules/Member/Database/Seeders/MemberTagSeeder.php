<?php

namespace Modules\Member\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Member\Models\MemberTag;

class MemberTagSeeder extends Seeder
{
    public function run(): void
    {
        MemberTag::factory()->count(10)->create();
    }
}
