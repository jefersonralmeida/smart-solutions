<?php

use Illuminate\Database\Seeder;

class PatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patients')->insert([[
            'name' => 'DAVID GILMOUR',
            'birthday' => '1946-03-06',
            'email' => 'david.gilmour@gmail.com',
            'phone' => '4133330010',
            'city' => 'SAO PAULO',
            'state' => 'SP',
            'gender' => 'M',
            'cellphone' => '41999990010',
            'clinic_id' => 2,
        ], [
            'name' => 'RICHARD WRIGHT',
            'birthday' => '1943-07-28',
            'email' => 'ricky.wright@gmail.com',
            'phone' => '4133330011',
            'city' => 'SOROCABA',
            'state' => 'SP',
            'gender' => 'M',
            'cellphone' => '41999990011',
            'clinic_id' => 2,
        ], [
            'name' => 'NICK MASON',
            'birthday' => '1944-01-27',
            'email' => 'nick.mason@gmail.com',
            'phone' => '4133330012',
            'city' => 'LONDRINA',
            'state' => 'PR',
            'gender' => 'M',
            'cellphone' => '41999990012',
            'clinic_id' => 3,
        ], [
            'name' => 'ROGER WATERS',
            'birthday' => '1943-09-09',
            'email' => 'roger.waters@gmail.com',
            'phone' => '4133330014',
            'city' => 'JOINVILLE',
            'state' => 'SC',
            'gender' => 'M',
            'cellphone' => '41999990014',
            'clinic_id' => 3,
        ]]);
    }
}
