<?php
namespace App\Services;

use App\Models\Currency;
use App\Models\CurrencyRate;
use GuzzleHttp\Client;

class CurrencyService
{
    const API_URL = 'https://api.exchangeratesapi.io/';

    public static function getCurrencyRates()
    {
        $query = [
            'access_key' => config('app.exchange_api_key'),
        ];
        $baseCurrency = config('app.currency_rate_base_currency');
        if (isset($baseCurrency)) {
            $query['base'] = $baseCurrency;
        }

        $client = new Client(['base_uri' => self::API_URL]);
        $res = $client->request('GET', 'latest', [
            'query' => $query,
        ]);

        // Get the response as JSON
        $response = json_decode($res->getBody()->getContents(), true);

        // Check for the "rates" key in the response and return it
        if (isset($response['rates'])) {
            return $response['rates'];
        } else {
            throw new \Exception('Rates not found in the response');
        }
    }

    public static function loadTodaysRates() {
        $rates = self::getCurrencyRates();

        foreach ($rates as $currencyCode => $rate) {

            $currency = Currency::firstOrCreate([
                'code' => $currencyCode,
                'name' => $currencyCode,
            ]);

            $currency->rates()->create([
                'rate' => $rate,
            ]);
        }
    }

    public function getRatesByDate(string $date): array
    {
        // Assuming you have a model named CurrencyRate to interact with the database
        return CurrencyRate::whereDate('created_at', $date)->get()->toArray();
    }
        
}
