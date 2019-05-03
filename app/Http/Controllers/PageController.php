<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Slide;
use App\Product;
use App\ProductType;
use App\BillDetail;
use App\Cart;
use App\Customer;
use App\Bill;
use App\User;
use Session;
use Hash;
use Auth;

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
        $best_sellers = BillDetail::select(array('products.*' ,DB::raw("SUM(quantity) as count")))->
        join('products', 'bill_detail.id_product', '=', 'products.id')->groupBy('id_product')->orderby('count', 'desc')->limit(4)->get();
        return view('page.product_detail', compact('san_pham', 'sp_related', 'new_products', 'best_sellers'));
    }

    public function getContacts()
    {
        return view('page.contacts');
    }

    public function login()
    {
        return view('page.login');
    }

    public function signUp()
    {
        return view('page.signup');
    }


    public function getPrice()
    {
        return view('page.pricing');
    }

    public function getGioiThieu()
    {
        return view('page.about');
    }

    public function getAddToCart(Request $req, $id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getDeleteCart(Request $req, $id)
    {
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        $req->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getCheckout()
    {
        return view('page.checkout');
    }

    public function postCheckout(Request $req)
    {
        $cart = Session::get('cart');
        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->email = $req->email;
        $customer->address = $req->adress;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;

        $customer->save();
        $bill = new Bill;

        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $billDetail = new BillDetail;
            $billDetail->id_bill = $bill->id;
            $billDetail->id_product = $key;
            $billDetail->quantity = $value['qty'];
            $billDetail->unit_price = $value['price']/$value['qty'];

            $billDetail->save();
        }

        Session::forget('cart');
        return redirect()->back()->with('thongbao', 'Dat Hang Thanh Cong');
    }

    public function postSignUp(Request $req)
    {
        $this->validate($req,
        [
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:20',
            'fullname'=>'required',
            're_password'=>'required|same:password'
        ],
        [
            'email.required'=>'Vui Long Nhap Email',
            'email.email'=>'khong dung dinh dang',
            'email.unique'=>'email da co nguoi su dung',
            'password.required'=>'vui long nhap password',
            'fullname.required'=>'vui long nhap full name',
            'password.min'=>'mat khau it nhat 6 ky tu'
        ]);
        $user = new User();
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();
        return redirect()->back()->with('thanhcong', 'Tao Tai Khoan Thanh Cong');
    }

    public function postLogin(Request $req)
    {
        $this->validate($req,
        [
            'email'=>'required|email',
            'password'=>'required|min:6|max:20',
        ],
        [
            'email.required'=>'Vui Long Nhap Email',
            'email.email'=>'khong dung dinh dang',
            'password.required'=>'vui long nhap password',
            'password.min'=>'mat khau it nhat 6 ky tu'
        ]);
        $credentials = array('email'=>$req->email, 'password'=>$req->password);
        if(Auth::attempt($credentials)){
            return redirect()->route('trang-chu')->with(['massage' => 'Dang Nhap Thanh Cong', 'flag' => 'success']);
        }
        else
        {
            return redirect()->back()->with(['massage' => 'Tài Khoản Hoặc Mật Khẩu Không Đúng', 'flag' => 'danger']);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('trang-chu');
    }
}
