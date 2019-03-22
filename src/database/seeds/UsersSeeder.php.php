<?php

use Illuminate\Database\Seeder;

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
            'name' => 'John Doe',
            'email' => 'dentista@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'dentista',
        ]);
    }
}
