<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    public $guarded = [];
    public $timestamps = false;
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
