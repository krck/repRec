<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Common\Enums\EnumRole;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Roles with Enum values
        foreach (EnumRole::cases() as $role) {
            Role::updateOrCreate(
                ['id' => $role->value],
                ['name' => $role->name]
            );
        }
    }
}
