<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $guarded = [];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function combo_items(){
        return $this->hasMany(ComboItem::class);
    }
    public function options(){
        return $this->hasMany(Option::class);
    }
    public function posales(){
        return $this->hasMany(Posale::class);
    }
    public function stock(){
        return $this->hasOne(Stock::class);
    }
    public function sales(){
        return $this->belongsToMany(Sale::class)->withPivot('quantity','cost','price');
    }
    public function purchases(){
        return $this->belongsToMany(Purchase::class)->withPivot('quantity','cost','price');
    }
}
