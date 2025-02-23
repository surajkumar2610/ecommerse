<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    function index(){
        $products = Products::paginate(3);
        return view('products', compact('products'));
    }
    function details($slug){
        $product = Products::where('slug',$slug)->first();
        return view('details', compact('product'));
    }
    function addToCart($id){
        $cart = new Cart();
        $cart->user_id = auth()->user()->id;
        $cart->product_id= $id;
        if($cart->save()){
            return redirect()->back()->with('success', 'Product has been added to cart');
        }
        return redirect()->back()->with('erroe', 'Something went wrong');
    }
    function showcart(){
        $cartItem = DB::table("cart")
        ->join('products', 'cart.product_id', '=', 'product_id')
        ->select("cart.product_id", DB::raw("count(*) as quantity"),"products.title", "products.price", "products.image")
        ->where("cart.user_id", auth()->user()->id)
        ->groupBy("cart.product_id", "products.title", "products.price", "products.image")
        ->paginate(2);
        return view('cart', compact('cartItem'));
    }
}
