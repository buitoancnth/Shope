<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Slide;
use App\Product;
use App\ProductType;
use App\BillDetail;

class PageController extends Controller
{
    public function getIndex()
    {
        $slides = Slide::all();
        $new_products = Product::where('new', 1)->paginate(4);
        $top_products = Product::where('promotion_price', '<>', 0)->paginate(8);
        return view('page.home', compact('slides', 'new_products', 'top_products'));
    }

    public function getTypeProduct($id_type)
    {
        $sp_theoloai = Product::where('id_type', $id_type)->get();
        $sp_khac = Product::where('id_type', '<>', $id_type)->paginate(3);
        $loai = ProductType::all();
        $name_loai_sp = ProductType::where('id', $id_type)->first();
        return view('page.type_product', compact('sp_theoloai', 'sp_khac', 'loai', 'name_loai_sp'));
    }

    public function getDetailProduct($id)
    {
        $san_pham = Product::find($id);
        $sp_related = Product::where('id_type', $san_pham->id_type)->where('id', '<>', $id)->paginate(3);
        $new_products = Product::where('new', 1)->limit(4)->get();
        $array_id = BillDetail::select(array('products.*' ,DB::raw("SUM(quantity) as count")))->
        join('products', 'bill_detail.id_product', '=', 'products.id')->groupBy('id_product')->orderby('count', 'desc')->limit(4)->get();
        dump($array_id);
        return view('page.product_detail', compact('san_pham', 'sp_related', 'new_products'));
    }

    public function getContacts()
    {
        return view('page.contacts');
    }

    public function login()
    {
        return view('page.login');
    }

    public function getPrice()
    {
        return view('page.pricing');
    }

    public function signUp()
    {
        # code...
    }

    public function getGioiThieu()
    {
        return view('page.about');
    }
}
