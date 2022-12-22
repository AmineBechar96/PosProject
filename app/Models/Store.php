<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    public $guarded = [];
    public function expences(){
        return $this->hasMany(Expence::class);
    }
    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
    public function registers(){
        return $this->hasMany(Register::class);
    }
    public function stocks(){
        return $this->hasMany(Stock::class);
    }
    public function tables(){
        return $this->hasMany(Table::class);
    }
    public function waiters(){
        return $this->hasMany(Waiter::class);
    }
    public function zones(){
        return $this->hasMany(Zone::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
