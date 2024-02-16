<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = ['payment_id','user_id','amount','user_account','status','total_points','point_value'];

    /**
     * Get the payment .
    */
    public function payment()
    {
        return $this->belongsTo(PaymentProvider::class,'payment_id');
    } 
}
