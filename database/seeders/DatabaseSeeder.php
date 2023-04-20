<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        $this->call([RolesAndPermissionSeeder::class,]);


        //user seeder
        DB::table('users')->insert([
            'name' => 'Bay',
            'last_name' => 'Admin',
            'email' => 'PMIS-Bay@admin.com',
            'password' => Hash::make('password'),
        ]);


        $user = User::findorfail(1);
        $user->assignRole('admin');

    }
}