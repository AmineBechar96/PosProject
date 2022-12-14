<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posale extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function register(){
        return $this->belongsTo(Register::class);
    }
    public function table(){
        return $this->belongsTo(Table::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function options(){
        return $this->belongsToMany(Option::class);
    }
}
