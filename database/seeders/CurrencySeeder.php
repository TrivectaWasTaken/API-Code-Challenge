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
        $currencyUSD = Currency::create([
            'name' => 'UNITED STATES DOLLAR',
            'symbol' => '$',
            'code' => 'USD',
        ]);

        $currencyGBP = Currency::create([
            'name' => 'BRITISH POUND',
            'symbol' => '£',
            'code' => 'GBP',
        ]);

        $currencyEUR = Currency::create([
            'name' => 'EURO',
            'symbol' => '€',
            'code' => 'EUR',
        ]);

        $currencyAUD = Currency::create([
            'name' => 'AUSTRALIAN DOLLAR',
            'symbol' => '$',
            'code' => 'AUD',
        ]);

        $currencyCAD = Currency::create([
            'name' => 'CANADIAN DOLLAR',
            'symbol' => '$',
            'code' => 'CAD',
        ]);

        $currencyUSD->rates()->create([
            'rate' => 1.0,
            'created_at' => now()->subDays(2),
        ]);

        $currencyGBP->rates()->create([
            'rate' => 0.72,
            'created_at' => now()->subDays(2),
        ]);

        $currencyEUR->rates()->create([
            'rate' => 0.83,
            'created_at' => now()->subDays(2),
        ]);

        $currencyAUD->rates()->create([
            'rate' => 1.29,
            'created_at' => now()->subDays(2),
        ]);

        $currencyCAD->rates()->create([
            'rate' => 1.25,
            'created_at' => now()->subDays(2),
        ]);
    }
}
