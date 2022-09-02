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
        $permisson = \App\Models\Permission::create([
            'name' => 'Manage Pages',
            'description' => 'Can manage pages',
            'page' => 'pages',
        ]);
        $admin = \App\Models\Role::create([
                'name' => 'admin',
                'description' => 'Administrator',
        ]);
        $admin->permissions()->attach($permisson);
        $user = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $user->roles()->attach($admin);
        \App\Models\User::factory(10)->create();
        \App\Models\Page::factory(10)->create();
        \App\Models\Tag::factory(10)->create();
    }
}
