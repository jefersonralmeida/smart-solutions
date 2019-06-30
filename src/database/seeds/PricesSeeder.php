<?php

use Illuminate\Database\Seeder;

class PricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prices')->insert([

            // Aligner
            [
                'product_id' => 1,
                'prices' => [
                    'smart_aligner_6' => 1100,
                    'smart_aligner_12' => 1650,
                    'smart_aligner_24' => 2750,
                    'smart_aligner_full' => 4000,
                    'alinhadores_extra' => 90,
                    'guia_colagem_indireta_impressao' => 250,
                    'guia_colagem_indireta_planejamento_1_guia' => 390,
                    'guia_colagem_indireta_planejamento_2_guias' => 470,
                ]
            ],

            // implant guiada
            [
                'product_id' => 3,
                'prices' => [
                    'price' => 500
                ]
            ],

            // Surgery
            [
                'product_id' => 4,
                'prices' => [
                    'price' => 500
                ]
            ],

            // ROG
            [
                'product_id' => 6,
                'prices' => [
                    'price' => 500
                ]
            ],

            // Esthetic
            [
                'product_id' => 7,
                'prices' => [
                    'price' => 500
                ]
            ],

            // aligner pre protese
            [
                'product_id' => 8,
                'prices' => [
                    'price' => 500
                ]
            ],
        ]);
    }
}
