<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PortfolioCurrencyController;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $user = Auth::guard()->user();
        $portfolios = Portfolio::where('user_id', $user->id)->get();
        foreach ($portfolios as $portfolio) {
            $portfolio->currencies = PortfolioCurrencyController::currencies($portfolio);
        }

        return $portfolios;
    }

    public function show(Portfolio $portfolio)
    {
        return $portfolio;
    }

    public function store(Request $request)
    {
        $portfolio = Portfolio::create($request->all());
        //lier les cryptos au portfolio
        $currencies = CurrencyController::by_symbols(array_keys($request['currencies']));
        foreach ($currencies as $currency) {
            $currency->quantity = $request['currencies'][$currency->symbol];
            PortfolioCurrencyController::create($portfolio, $currency);
        }


        return response()->json($portfolio, 201);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $portfolio->update($request->all());

        return response()->json($portfolio, 200);
    }

    public function delete(Portfolio $portfolio)
    {
        $portfolio->delete();

        return response()->json(null, 204);
    }
}
