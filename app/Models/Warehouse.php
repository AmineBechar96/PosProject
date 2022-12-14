<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    public $guarded = [];
    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
    public function stocks(){
        return $this->hasMany(Stock::class);
    }
}
