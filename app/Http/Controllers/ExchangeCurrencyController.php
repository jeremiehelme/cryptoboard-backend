<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CurrencyController;
use App\Models\ExchangeCurrency;
use App\Models\Exchange;

class ExchangeCurrencyController extends Controller
{
    public function index()
    {
        return ExchangeCurrency::all();
    }



    public static function currencies($exchanges)
    {
        foreach ($exchanges as $exchange) {
            $items = ExchangeCurrency::where('exchange_id', $exchange->id)->get();
            $currencies = [];
            foreach ($items as $item) {
                $currency = CurrencyController::by_id($item->currency_id);
                if ($currency->count()) {
                    $currency[0]->quantity = $item->quantity;
                    unset($currency[0]->id);
                    $currencies[] =  $currency[0];
                }
            };
            $exchange->currencies = $currencies;
        }
        return $exchanges;
    }



    public function store(Request $request)
    {
        $exchangeCurrency =
            ExchangeCurrency::where([
                ['exchange_id', $request['exchange_id']],
                ['currency_id', $request['currency_id']]
            ])->get();

        if ($exchangeCurrency->count() == 0) {
            $exchangeCurrency = ExchangeCurrency::create($request->all());
        }

        return response()->json($exchangeCurrency, 201);
    }

    public function update(Request $request, ExchangeCurrency $exchangeCurrency)
    {
        $exchangeCurrency->update($request->all());

        return response()->json($exchangeCurrency, 200);
    }

    public function delete(ExchangeCurrency $exchangeCurrency)
    {
        $exchangeCurrency->delete();

        return response()->json(null, 204);
    }
}
