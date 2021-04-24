<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $user_ip
 * @property int $product_id
 * @property float $product_price
 * @property int $product_count
 * @property int $exchange_rate_id
 * @property float $exchange_value
 */
class TransactionHistory extends Model
{
    use HasFactory;

    public function addTransaction(string $ip, Product $product, int $count, ExchangeRate $exchangeRate) : void
    {
        $this->user_ip = $ip;
        $this->product_id = $product->id;
        $this->product_price = $product->price;
        $this->product_count = $count;
        $this->exchange_rate_id = $exchangeRate->id;
        $this->exchange_value = $exchangeRate->value;
        $this->save();
    }

    public function product() : Product
    {
        return $this->hasOne(Product::class);
    }

    public function exchangeRate() : ExchangeRate
    {
        return $this->hasOne(ExchangeRate::class);
    }
}

