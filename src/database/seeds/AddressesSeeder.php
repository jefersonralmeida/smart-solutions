<?php

use Illuminate\Database\Seeder;

class AddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            [
                'identification' => 'MATRIZ',
                'receiver_name' => 'BRUCE WAYNE',
                'zip_code' => '82400000',
                'street' => 'AV MANOEL RIBAS',
                'street_number' => '7420',
                'district' => 'SANTA FELICIDADE',
                'address_details' => null,
                'city' => 'CURITIBA',
                'state' => 'PR',
                'reference_point' => null,
                'phone' => null,
                'clinic_id' => 1,
            ], [
                'identification' => 'MATRIZ',
                'receiver_name' => 'BARRY ALLEN',
                'zip_code' => '20123100',
                'street' => 'AV DAS FLORES',
                'street_number' => '1234',
                'district' => 'CAMPO BELO',
                'address_details' => null,
                'city' => 'RIO DE JANEIRO',
                'state' => 'RJ',
                'reference_point' => 'MERCADAO',
                'phone' => null,
                'clinic_id' => 2,
            ], [
                'identification' => 'FILIAL',
                'receiver_name' => 'OLIVER QUEEN',
                'zip_code' => '84070150',
                'street' => 'AV PRINCIPAL',
                'street_number' => '1528',
                'district' => 'NOVA RUSSIA',
                'address_details' => 'SALA 14',
                'reference_point' => 'SHOPPING',
                'city' => 'PONTA GROSSA',
                'state' => 'PR',
                'phone' => null,
                'clinic_id' => 2,
            ],
        ]);
    }
}
