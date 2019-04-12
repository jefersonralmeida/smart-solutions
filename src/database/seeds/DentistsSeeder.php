<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DentistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dentists')->insert([[
            'name' => 'FREDDIE MERCURY',
            'email' => 'dentista1@gmail.com',
            'cpf' => '88177030019',
            'phone' => '4133330001',
            'cro' => 'PRCD149',
            'city' => 'CURITIBA',
            'state' => 'PR',
            'cellphone' => '41999990001',
            'clinic_id' => 2,
            'cro_status' => 'A',
            'cro_dispatched_at' => now(),
            'cro_approved_at' => now(),
            'integration_status' => 'S',
            'integration_id' => '13'
        ], [
            'name' => 'BRIAN MAY',
            'email' => 'dentista2@gmail.com',
            'cpf' => '42001545010',
            'phone' => '43333300002',
            'cro' => 'PRCD167',
            'city' => 'LONDRINA',
            'state' => 'PR',
            'cellphone' => '43999990002',
            'clinic_id' => 2,
            'cro_status' => 'A',
            'cro_dispatched_at' => now(),
            'cro_approved_at' => now(),
            'integration_status' => 'S',
            'integration_id' => '14',
        ], [
            'name' => 'JOHN DEACON',
            'email' => 'dentista3@gmail.com',
            'cpf' => '24020397015',
            'phone' => '4233330003',
            'cro' => 'PRCD168',
            'city' => 'PONTA GROSSA',
            'state' => 'PR',
            'cellphone' => '42999990003',
            'clinic_id' => 3,
            'cro_status' => 'A',
            'cro_dispatched_at' => now(),
            'cro_approved_at' => now(),
            'integration_status' => 'S',
            'integration_id' => '15',
        ], [
            'name' => 'ROGER TAYLOR',
            'email' => 'dentista4@gmail.com',
            'cpf' => '83787633073',
            'phone' => '4433330004',
            'cro' => 'PRCD303',
            'city' => 'MARINGA',
            'state' => 'PR',
            'cellphone' => '44999990004',
            'clinic_id' => 3,
            'cro_status' => 'A',
            'cro_dispatched_at' => now(),
            'cro_approved_at' => now(),
            'integration_status' => 'S',
            'integration_id' => '16',
        ]]);
    }
}
