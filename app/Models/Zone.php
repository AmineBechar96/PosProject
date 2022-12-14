<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $guarded = [];
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function tables(){
        return $this->hasMany(Table::class);
    }
}
