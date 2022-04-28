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



    public static function currencies($portfolio)
    {

        $currencies = [];
        $items = PortfolioCurrency::where('portfolio_id', $portfolio->id)->get();
        foreach ($items as $item) {
            $currency = CurrencyController::by_id($item->currency_id);
            if ($currency->count()) {
                $currencies[] =  $currency[0];
            }
        };

        return $currencies;
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
