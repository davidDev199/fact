<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            [
                'id' => 'PEN', 
                'description' => 'Sol Peruano'
            ],
            [
                'id' => 'USD', 
                'description' => 'Dólar Americano'
            ],
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
