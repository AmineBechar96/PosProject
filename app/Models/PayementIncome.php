<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayementIncome extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function register(){
        return $this->belongsTo(Register::class);
    }
    public function sale(){
        return $this->belongsTo(Sale::class);
    }
    public function waiter(){
        return $this->belongsTo(Waiter::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
