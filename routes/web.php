<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;

Route::get('/', fn() => view('index', [
    'products' => Product::all(),
    'categories' => Category::orderBy('category_id')->orderBy('created_at')->get()])
);
