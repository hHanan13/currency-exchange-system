<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = config('exchange_rates');
        return view('currencies.index', compact('currencies'));
    }

    public function store(Request $request)
    {
        $currency = $request->input('currency');
        $rate = $request->input('rate');

        $configPath = config_path('exchange_rates.php');
        $currencies = config('exchange_rates');
        $currencies[$currency] = $rate;

        file_put_contents($configPath, '<?php return ' . var_export($currencies, true) . ';');
        
        return redirect()->route('currencies.index');
    }

    public function update(Request $request, $currency)
    {
        $rate = $request->input('rate');

        $configPath = config_path('exchange_rates.php');
        $currencies = config('exchange_rates');
        $currencies[$currency] = $rate;

        file_put_contents($configPath, '<?php return ' . var_export($currencies, true) . ';');

        return redirect()->route('currencies.index');
    }

    public function destroy($currency)
    {
        $configPath = config_path('exchange_rates.php');
        $currencies = config('exchange_rates');
        unset($currencies[$currency]);

        file_put_contents($configPath, '<?php return ' . var_export($currencies, true) . ';');

        return redirect()->route('currencies.index');
    }
}
