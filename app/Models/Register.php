<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;
    public $guarded = [];
    public function holds(){
        return $this->hasMany(Hold::class);
    }
    public function payementIncomes(){
        return $this->hasMany(PayementIncome::class);
    }
    public function payementOutcomes(){
        return $this->hasMany(payementOutcome::class);
    }
    public function posales(){
        return $this->hasMany(Posale::class);
    }
    public function sales(){
        return $this->hasMany(Sale::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
    public function waiters(){
        return $this->belongsToMany(Waiter::class)->withPivot('cash_in_hand');
    }
    
}
