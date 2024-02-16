<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentProvider extends Model
{
    use HasFactory;

    /**
     * Get deposits.
    */
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
}
