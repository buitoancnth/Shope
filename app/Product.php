<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function product_Type()
    {
        return $this->belongsto('App\ProductType', 'id_type', 'id');
    }

    public function bill_Detail()
    {
        return $this->belongstoMany('App\BillDetail', 'table_medium', 'id_product', 'id');
    }
}
