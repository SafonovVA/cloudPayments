<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 */
class Product extends Model
{
    use HasFactory;

    public function category() : Category
    {
        return $this->hasOne(Category::class);
    }

    public function transactionHistories() : Illuminate\Support\Collection
    {
        return $this->hasMany(TransactionHistories::class);
    }
}
