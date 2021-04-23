<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ExchangeRate;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();

        // For Cron
        /*$response = Http::get('https://nationalbank.kz/rss/rates_all.xml');
        $XMLResponse = new \SimpleXMLElement($response);
        foreach($XMLResponse->channel->item as $item) {
            ExchangeRate::updateOrCreate(
                ['title' => $item->title],
                ['value' => $item->description]
            );
        }*/
        //End cron

        return view('index', compact('products', 'categories'));
    }
}
