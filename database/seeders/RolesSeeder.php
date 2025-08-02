<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::insert([
            [
                "name" => "admin",
                "guard_name" => "web"
            ],
            [
                "name" => "host",
                "guard_name" => "web"
            ],
            [
                "name" => "client",
                "guard_name" => "web"
            ],
        ]);
    }
}
