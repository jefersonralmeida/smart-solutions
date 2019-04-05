<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clinics')->insert([[
            'name' => 'CLINICA TIRADENTES',
            'cnpj' => '62184051000178',
        ], [
            'name' => 'DROLHAS ORTODENTIA',
            'cnpj' => '14297952000123',
        ]]);
    }
}
