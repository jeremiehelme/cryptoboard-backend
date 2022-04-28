<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortfolioCurrency;


class PortfolioCurrencyController extends Controller
{
    public function index()
    {
        return PortfolioCurrency::all();
    }



    public static function currencies($exchanges)
    {
        foreach ($exchanges as $exchange) {
            $items = PortfolioCurrency::where('exchange_id', $exchange->id)->get();
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



    public static function create($portfolio, $currency)
    {
        $portfolioCurrency =
            PortfolioCurrency::where([
                ['portfolio_id', $portfolio->id],
                ['currency_id', $currency->id]
            ])->get();

        if ($portfolioCurrency->count() === 0) {
            $portfolioCurrency = PortfolioCurrency::create([
                'portfolio_id' => $portfolio->id,
                'currency_id' => $currency->id
            ]);
        }

        return response()->json($portfolioCurrency, 201);
    }

    public function store(Request $request)
    {
        $portfolioCurrency =
            PortfolioCurrency::where([
                ['portfolio_id', $request['portfolio_id']],
                ['currency_id', $request['currency_id']]
            ])->get();

        if ($portfolioCurrency->count() === 0) {
            $portfolioCurrency = PortfolioCurrency::create($request->all());
        }

        return response()->json($portfolioCurrency, 201);
    }

    public function update(Request $request, PortfolioCurrency $portfolioCurrency)
    {
        $portfolioCurrency->update($request->all());

        return response()->json($portfolioCurrency, 200);
    }

    public function delete(PortfolioCurrency $portfolioCurrency)
    {
        $portfolioCurrency->delete();

        return response()->json(null, 204);
    }
}
