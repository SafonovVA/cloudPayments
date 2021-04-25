<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;

Route::get('/', fn() => view('index', [
    'products' => Product::orderBy('category_id')->orderBy('created_at')->get(),
    'categories' => Category::all()])
);
