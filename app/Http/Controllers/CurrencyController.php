<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    public function index()
    {
        return Currency::all();
    }

    public static function by_id($id)
    {
        return Currency::where("id", $id)->get();
    }

    public static function by_ids($ids)
    {
        return Currency::whereIn("id", $ids)->get();
    }

    public static function by_symbols($symbols)
    {
        return Currency::whereIn("symbol", $symbols)->get();
    }

    public function show(Currency $currency)
    {
        return $currency;
    }

    public function store(Request $request)
    {
        try {
            $currency = Currency::create($request->all());
        } catch (QueryException $e) {
            //si la currency existe deja dans la bdd, la retourner
            $currency = Currency::where('symbol', $request['symbol'])->get();
        }
        return response()->json($currency, 201);
    }

    public function update(Request $request, Currency $currency)
    {
        $currency->update($request->all());

        return response()->json($currency, 200);
    }

    public function delete(Currency $currency)
    {
        $currency->delete();

        return response()->json(null, 204);
    }
}
