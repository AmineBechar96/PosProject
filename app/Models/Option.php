<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function posales(){
        return $this->belongsToMany(Posale::class);
    }
}
