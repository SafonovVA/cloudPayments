<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use App\Models\Product;
use App\Models\TransactionHistory;
use App\Http\Requests\PurchaseSuccessRequest;

class PurchaseSuccess extends Controller
{
    public function __invoke(PurchaseSuccessRequest $request)
    {
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
    }
}
