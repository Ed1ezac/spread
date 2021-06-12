<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'send smses']);
        Permission::create(['name' => 'access admin panel']);
        Permission::create(['name' => 'access super admin panel']);

        $role = Role::create(['name' => User::Client]);
        $role->givePermissionTo('send smses');

        $role = Role::create(['name' => User::Moderator]);
        $role->givePermissionTo('access admin panel');

        $role = Role::create(['name' => User::Administrator]);
        $role->givePermissionTo(Permission::all());
    }
}
