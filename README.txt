README:

In order to run the unit test, you can use the below:
php artisan test

To run the scheduler task, in order to get the daily rates:
> use App\Services\CurrencyService;
> CurrencyService::loadTodaysRates();