<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiter extends Model
{
    use HasFactory;
    public $guarded = [];
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function holds(){
        return $this->hasMany(Hold::class);
    }
    public function payementIncomes(){
        return $this->hasMany(PayementIncome::class);
    }
    public function payementOutcomes(){
        return $this->hasMany(PayementOutcome::class);
    }
    public function sales(){
        return $this->hasMany(Sale::class);
    }
    public function registers(){
        return $this->belongsToMany(Register::class)->withPivot('cash_in_hand');
    }

}
