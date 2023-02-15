<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products() {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity')->withTimestamps();
    }

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }

}
