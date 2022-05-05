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

    public function show(int $id)
    {
        $portfolio = Portfolio::find($id);
        $portfolio->currencies = PortfolioCurrencyController::currencies($portfolio);
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

    public function update(Request $request, int $id)
    {
        $portfolio = Portfolio::find($id);
        $portfolio->update($request->all());
        //delete all PortfolioCurrency
        PortfolioCurrencyController::delete($id);
        //create PortfolioCurrency
        $currencies = CurrencyController::by_symbols(array_keys($request['currencies']));
        foreach ($currencies as $currency) {
            $currency->quantity = $request['currencies'][$currency->symbol];
            PortfolioCurrencyController::create($portfolio, $currency);
        }
        return response()->json($portfolio, 200);
    }

    public function delete(int $id)
    {
        $portfolio = Portfolio::find($id);
        $portfolio->delete();
        return response()->json(null, 204);
    }
}
