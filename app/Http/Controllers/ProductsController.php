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
        $userId = auth()->user()->id;
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();
    
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->product_id = $id;
            $cart->quantity = 1;
            $cart->save();
        }
        return redirect()->back()->with('success', 'Product has been added to cart');
    }

    function showcart(){
        $userId = auth()->user()->id;

        $cartItem = DB::table("cart")
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->select("cart.product_id", "cart.quantity", "products.title", "products.price", "products.image")
            ->where("cart.user_id", $userId)
            ->get();
        return view('cart', compact('cartItem'));
    }

    public function updateCart(Request $request){
        $request->validate([
            'product_id' => 'required|integer',
            'action' => 'required|string|in:increase,decrease'
        ]);
        $userId = auth()->user()->id;
        $productId = $request->product_id;
        $action = $request->action;
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();
        if ($cartItem) {
            if ($action === "increase") {
                $cartItem->quantity += 1;
            } elseif ($action === "decrease") {
                if ($cartItem->quantity > 1) {
                    $cartItem->quantity -= 1;
                } else {
                    $cartItem->delete();
                    return response()->json(['success' => true, 'removed' => true]);
                }
            }
            $cartItem->save();
        }
        return response()->json(['success' => true, 'quantity' => $cartItem->quantity]);
    }
}
