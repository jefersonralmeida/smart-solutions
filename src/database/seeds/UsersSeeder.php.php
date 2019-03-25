<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'name' => 'ROBERT PLANT',
            'email' => 'dentista1@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'dentista',
            'cpf_cnpj' => '88177030019',
            'phone' => '4133330001',
            'cro' => 'PR-CD-149',
            'city' => 'CURITIBA',
            'state' => 'PR',
            'cellphone' => '41999990001',
        ], [
            'name' => 'JIMMY PAGE',
            'email' => 'dentista2@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'dentista',
            'cpf_cnpj' => '42001545010',
            'phone' => '43333300002',
            'cro' => 'PR-CD-167',
            'city' => 'LONDRINA',
            'state' => 'PR',
            'cellphone' => '43999990002',
        ], [
            'name' => 'JOHN PAUL JONES',
            'email' => 'dentista3@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'dentista',
            'cpf_cnpj' => '84124281000184',
            'phone' => '4233330003',
            'cro' => 'PR-CD-168',
            'city' => 'PONTA GROSSA',
            'state' => 'PR',
            'cellphone' => '42999990003',
        ], [
            'name' => 'JOHN BONHAM',
            'email' => 'dentista4@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'dentista',
            'cpf_cnpj' => '44658338000100',
            'phone' => '4433330004',
            'cro' => 'PR-CD-303',
            'city' => 'MARINGA',
            'state' => 'PR',
            'cellphone' => '44999990004',
        ]]);
    }
}
