<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::create([
                'name' => 'admin',
                'description' => 'Administrator',
                'can_edit_pages' => true,
                'can_edit_users' => true,
                'can_edit_permissions' => true,
                'can_edit_roles' => true,
                'can_edit_tags' => true,
            ]);
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        \App\Models\User::factory(10)->create();
        \App\Models\Page::factory(10)->create();
        \App\Models\Tag::factory(10)->create();
    }
}
