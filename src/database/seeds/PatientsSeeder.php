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
        ]]);
    }
}
