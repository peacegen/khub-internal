<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $role = Role::create(['name' => 'admin']);
        $super = Role::create(['name' => 'super-admin']);
        $super->syncPermissions(Permission::all());
        $user->assignRole($super);
        \App\Models\User::factory(10)->create();
        \App\Models\Page::factory(10)->create();
        \App\Models\Tag::factory(3)->create();
    }
}
