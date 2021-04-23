<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ExchangeRate;
use App\Http\Resources\ExchangeRateResource;

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('exchange-rate/{title}', function($title) {
    return new ExchangeRateResource(ExchangeRate::where('title', $title)->first());
});
