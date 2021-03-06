<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    // Campos activos
    protected $fillable = [
        'id_enrollment',
        'id_payment_type',
        'amount_total',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'verified',
        'verified_at',
        'verified_by',
        'active'
    ];

    public function payment_detail(){
        return $this->hasMany('App\Models\PaymentDetail', 'id_payment', 'id');
    }
    

}
