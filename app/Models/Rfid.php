<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfid extends Model
{
    use HasFactory;

    protected $fillable = ['tag_id', 'product_id', 'status'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function latestLocation()
    {
         return $this->hasOne(RfidLocation::class, 'tag_id', 'tag_id')->latestOfMany();
    }
}

