<?php

use Illuminate\Support\Facades\Route;
use App\Models\ExchangeRate;
use App\Http\Resources\ExchangeRateResource;
use App\Http\Controllers\Api\PurchaseSuccess;


Route::get('exchange-rate/{title}', fn($title) =>
    new ExchangeRateResource(ExchangeRate::where('title', $title)->first()));

Route::patch('purchase-success', Api\PurchaseSuccess::class);
