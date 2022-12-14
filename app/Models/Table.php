<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    public $guarded = [];
    public $timestamps = false;
    public function holds(){
        return $this->hasMany(Hold::class);
    }
    public function posales(){
        return $this->hasMany(Posale::class);
    }
    public function zone(){
        return $this->belongsTo(Zone::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
}
