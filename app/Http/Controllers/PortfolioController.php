<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function index()
    {
        $user = Auth::guard()->user();
        return Portfolio::where('user_id', $user->id)->get();
    }

    public function show(Portfolio $exchange)
    {
        return $exchange;
    }

    public function store(Request $request)
    {
        $user = Auth::guard()->user(); //TODO make sure user exists
        $portfolio = Portfolio::create($request->all());

        //lier les cryptos au portfolio
        

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
