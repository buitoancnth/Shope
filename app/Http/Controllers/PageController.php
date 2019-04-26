<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
class PageController extends Controller
{
    public function getIndex()
    {
        $slides = Slide::all();
        $new_products = Product::where('new', 1)->paginate(4);
        $top_products = Product::where('promotion_price', '<>', 0)->paginate(8);
        // $top_products = Product::where()
        return view('page.home', compact('slides', 'new_products', 'top_products'));
    }

    public function getTypeProduct()
    {
        return view('page.type_product');
    }

    public function getAllProduct()
    {
        return view('page.product_detail');
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
}
