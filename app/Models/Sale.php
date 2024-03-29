<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{   public $guarded = [];
    use HasFactory;
    public function register(){
        return $this->belongsTo(Register::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function waiter(){
        return $this->belongsTo(Waiter::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function payementIncomes(){
        return $this->hasMany(PayementIncome::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('quantity','price','date');
    }
}
