<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function fetchLatestRates(Request $request)
    {
        try {
            // Fetch the latest currency rates using the CurrencyService
            $rates = $this->currencyService->getCurrencyRates();
            return response()->json($rates);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getRatesByDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
        ]);

        try {
            $date = $request->input('date');
            $rates = $this->currencyService->getRatesByDate($date);
            return response()->json($rates);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}