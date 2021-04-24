<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ExchangeRate;
use App\Models\Product;
use App\Models\TransactionHistory;
use App\Http\Resources\ExchangeRateResource;
use App\Http\Requests\AfterPurchaseRequest;


Route::get('exchange-rate/{title}', function($title) {
    return new ExchangeRateResource(ExchangeRate::where('title', $title)->first());
});

Route::patch('action-after-purchase', function(AfterPurchaseRequest $request) {
//Route::patch('action-after-purchase', function(Request $request) {
    $productId = $request->input('productId');
    $count = $request->input('count');

    $product = Product::find($productId);
    $product->count = $product->count - $count;
    $product->save();


    $exchangeTitle = $request->input('exchangeTitle');
    $exchangeRate = ExchangeRate::where('title', $exchangeTitle)->first();

    $transactionHistory = new TransactionHistory();
    $transactionHistory->addTransaction($request->ip(), $product, $count, $exchangeRate);

    return 0;
});
