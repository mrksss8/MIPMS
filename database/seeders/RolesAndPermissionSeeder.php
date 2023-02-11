<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();    

        // create permissions
        Permission::create(['name' => 'Doctor Permission']);
        Permission::create(['name' => 'Nurse Permission']);
        
        //create role
        $admin_role = Role::create(['name' => 'Admin']);
        $doctor_role = Role::create(['name' => 'Doctor']);
        $nurse_role = Role::create(['name' => 'Nurse']);

        //add all permission to role
        $admin_role->givePermissionTo(Permission::all());
        $doctor_role->givePermissionTo('Doctor Permission');
        $nurse_role->givePermissionTo('Nurse Permission');


    }
}
