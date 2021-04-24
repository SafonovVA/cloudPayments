<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 */
class Category extends Model
{
    use HasFactory;

    public function products() : Illuminate\Support\Collection
    {
        return $this->hasMany(Product::class);
    }
}
