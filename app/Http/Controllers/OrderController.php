<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    function showcheckout(){
        return view('checkout');
    }

    function checkoutPost(Request $request){
        $request->validate([
            'address' => 'required',
            'pincode' => 'required',
            'number' => 'required',
        ]);
    
        $userId = auth()->user()->id;
    
        $cartItems = DB::table("cart")
            ->join('products', 'cart.product_id', '=', 'products.id') // Fixed alias
            ->select("cart.product_id", "cart.quantity", "products.price")
            ->where("cart.user_id", $userId)
            ->get();
    
        if ($cartItems->isEmpty()) {
            return redirect(route('cart.show'))->with("error", "Cart is empty");
        }
    
        $productIds = [];
        $quantities = [];
        $totalPrice = 0;
    
        foreach ($cartItems as $item) {
            $productIds[] = $item->product_id;
            $quantities[] = $item->quantity;
            $totalPrice += $item->price * $item->quantity; // Fixed total price calculation
        }
    
        $order = new Orders();
        $order->user_id = $userId;
        $order->address = $request->address;
        $order->pincode = $request->pincode;
        $order->number = $request->number;
        $order->product_id = json_encode($productIds);
        $order->total_price = $totalPrice;
        $order->quantity = json_encode($quantities);
    
        if ($order->save()) {
            DB::table('cart')->where("user_id", $userId)->delete();
            return redirect(route('cart.show'))->with("success", "Order has been placed successfully!");
        }
    
        return redirect(route('cart.show'))->with("error", "An error occurred while placing the order.");
    }
    
}
