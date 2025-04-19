<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'quantity', 'price', 'size', 'category', 'type'];

        /**
     * Get the product instance associated with this RFID tag.
     */
    public function rfids()
    {
        return $this->hasMany(Rfid::class,'product_id');
    }
}

