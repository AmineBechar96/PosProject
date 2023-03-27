<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayementOutcome extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $guarded = [];
    public function register(){
        return $this->belongsTo(Register::class);
    }
    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
    public function waiter(){
        return $this->belongsTo(Waiter::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
