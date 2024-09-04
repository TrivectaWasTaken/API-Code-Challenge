<?php

namespace Tests\Unit;

use App\Services\CurrencyService;
use App\Models\CurrencyRate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class CurrencyServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $currencyService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->currencyService = new CurrencyService();
    }

    public function testGetRatesByDateReturnsRates()
    {
        $date = '2023-10-01';
        $expectedRates = [
            ['currency' => 'USD', 'rate' => 1.0],
            ['currency' => 'EUR', 'rate' => 0.85],
        ];


        $currencyRateMock = Mockery::mock('alias:App\Models\CurrencyRate');
        $currencyRateMock->shouldReceive('whereDate')
            ->with('created_at', $date)
            ->andReturnSelf();
        $currencyRateMock->shouldReceive('get')
            ->andReturn(collect($expectedRates));

        $rates = $this->currencyService->getRatesByDate($date);

        $this->assertEquals($expectedRates, $rates);
    }

    public function testGetRatesByDateReturnsEmptyArrayWhenNoRates()
    {
        $date = '2023-10-01';

        // Mock the CurrencyRate model
        $currencyRateMock = Mockery::mock('alias:App\Models\CurrencyRate');
        $currencyRateMock->shouldReceive('whereDate')
            ->with('created_at', $date)
            ->andReturnSelf();
        $currencyRateMock->shouldReceive('get')
            ->andReturn(collect([]));

        $rates = $this->currencyService->getRatesByDate($date);

        $this->assertEmpty($rates);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}