<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';

    public function bill_Detail()
    {
    	return $this->hasMany('App\BillDetail', 'id_bill', 'id');
    }

    public function customer()
    {
    	return $this->belongsto('App\Customer', 'id_customer', 'id');
    }
}
