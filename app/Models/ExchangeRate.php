<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "exchange_rates".
 *
 * @property int $id
 * @property string $title
 * @property float $value
 */
class ExchangeRate extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'value'];

    public function transactionHistories() : Illuminate\Support\Collection
    {
        return $this->hasMany(TransactionHistories::class);
    }
}
