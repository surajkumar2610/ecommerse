<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    function showcheckout(){ 
        $user = auth()->user();
        $latestOrder = Orders::where('user_id', $user->id)
                            ->latest()
                            ->first();
        return view('checkout', compact('latestOrder'));
    }

    public function checkoutPost(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'pincode' => 'required|digits:6',
            'number' => 'required|digits:10',
        ]);
    
        $user = auth()->user();
        $user->update([
            'address' => $request->address,
            'pincode' => $request->pincode,
            'number' => $request->number
        ]);
    
        $cartItems = DB::table("cart")
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->select("cart.product_id", "cart.quantity", "products.price")
            ->where("cart.user_id", $user->id)
            ->get();
    
        if ($cartItems->isEmpty()) {
            return redirect(route('cart.show'))->with("error", "Cart is empty");
        }
    
        $productIds = $cartItems->pluck('product_id')->toArray();
        $quantities = $cartItems->pluck('quantity')->toArray();
        $totalPrice = $cartItems->sum(fn($item) => $item->price * $item->quantity);
    
        $order = Orders::create([
            'user_id' => $user->id,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'number' => $request->number,
            'product_id' => json_encode($productIds),
            'total_price' => $totalPrice,
            'quantity' => json_encode($quantities),
        ]);
    
        if ($order) {
            DB::table('cart')->where("user_id", $user->id)->delete();
            return redirect(route('cart.show'))->with("success", "Order placed successfully!");
        }
        return redirect(route('cart.show'))->with("error", "Failed to place order.");
    }
    
    public function orderHistory()
    {
        $orders = Orders::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('history', compact('orders'));
    }

    
}
