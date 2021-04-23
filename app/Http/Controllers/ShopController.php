<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        return view('index', compact('products', 'categories'));
    }
}
