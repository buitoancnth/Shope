<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = 'bill_detail';

   	public function product()
   	{
   		return $this->belongstoMany('App\Product', 'table_medium', 'id_product', 'id');
   	}

 	public function bill()
 	{
 		return $this->belongsto('App\Bill', 'id_bill', 'id');
 	}
}
