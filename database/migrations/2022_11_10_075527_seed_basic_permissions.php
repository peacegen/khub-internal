<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Permission::create(['name' => 'create pages']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'create tags']);
        Permission::create(['name' => 'edit pages']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'edit tags']);
        Permission::create(['name' => 'delete pages']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'delete roles']);
        Permission::create(['name' => 'delete tags']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
};
