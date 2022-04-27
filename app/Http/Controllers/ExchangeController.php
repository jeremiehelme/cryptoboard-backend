<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\Exchange;
use App\Http\Controllers\ExchangeCurrencyController;


class ExchangeController extends Controller
{
    public function index()
    {
        $user = Auth::guard()->user();
        $exchanges = Exchange::where('user_id', $user->id)->get();
        //get currencies associated
        $exchanges = ExchangeCurrencyController::currencies($exchanges);
        return $exchanges;
    }

    public function show(Exchange $exchange)
    {
        return $exchange;
    }

    public function store(Request $request)
    {
        try {
            $exchange = Exchange::create($request->all());
        } catch (QueryException $e) {
            //si la currency existe deja dans la bdd, la retourner
            $exchange = Exchange::where('exchange_id', $request['exchange_id'])->get();
        }
        return response()->json($exchange, 201);
    }

    public function update(Request $request, Exchange $exchange)
    {
        $exchange->update($request->all());

        return response()->json($exchange, 200);
    }

    public function delete(Exchange $exchange)
    {
        $exchange->delete();

        return response()->json(null, 204);
    }
}
