<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmountController extends Controller
{
    public function index()
    {
        $amounts = Auth::user()->amounts;
        $exchangeRates = config('exchange_rates');

        return view('amounts.index', compact('amounts', 'exchangeRates'));
    }

    public function store(Request $request)
    {
        $amount = new Amount();
        $amount->user_id = Auth::id();
        $amount->amount = $request->input('amount');
        $amount->save();

        return redirect()->route('amounts.index');
    }

    public function update(Request $request, $id)
    {
        $amount = Amount::findOrFail($id);
        $amount->amount = $request->input('amount');
        $amount->save();

        return redirect()->route('amounts.index');
    }

    public function destroy($id)
    {
        $amount = Amount::findOrFail($id);
        $amount->delete();

        return redirect()->route('amounts.index');
    }
}
