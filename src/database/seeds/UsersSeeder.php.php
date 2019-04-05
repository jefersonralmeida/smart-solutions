<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            // 1 - user without clinic
            [
                'name' => 'ROBERT PLANT',
                'email' => 'noclinic@gmail.com',
                'password' => Hash::make('password'),
                'api_token' => Str::random(60),
                'clinic_id' => null,
                'dentist_id' => null,
                'permissions' => json_encode([]),
            ],

            // 2 - clinic1 admin (can create dentists)
            [
                'name' => 'JIMMY PAGE',
                'email' => 'nodentist@gmail.com',
                'password' => Hash::make('password'),
                'api_token' => Str::random(60),
                'clinic_id' => 1,
                'dentist_id' => null,
                'permissions' => json_encode(['clinic-admin', 'manage_permissions', 'create_dentist', 'order']),
            ],

            // 3 - clinic2 admin (can create dentists)
            [
                'name' => 'JOHN PAUL JONES',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('password'),
                'api_token' => Str::random(60),
                'clinic_id' => 1,
                'dentist_id' => null,
                'permissions' => json_encode(['manage_permissions', 'create_dentist', 'order']),
            ],

            // 4 - clinic1 simple user
            [
                'name' => 'JOHN BONHAM',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('password'),
                'api_token' => Str::random(60),
                'clinic_id' => 1,
                'dentist_id' => null,
                'permissions' => json_encode(['order']),
            ],

        ]);
    }
}
