<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hold extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $guarded = [];
    public function register(){
        return $this->belongsTo(Register::class);
    }
    public function table(){
        return $this->belongsTo(Table::class);
    }
    public function waiter(){
        return $this->belongsTo(Waiter::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
