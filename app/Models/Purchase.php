<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function payementOutcomes(){
        return $this->hasMany(PayementOutcome::class);
    }
    public function products(){
        
        return $this->belongsToMany(Product::class)->withPivot('quantity','price','date');}
}
