<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboItem extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = ['quantity'];
    public function item(){
        return $this->belongsTo(Product::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    
}
