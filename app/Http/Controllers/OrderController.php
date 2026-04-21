<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Admin: Display a listing of all orders.
     */
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * User: Checkout and create a new order from cart.
     */
    public function store(Request $request)
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        DB::transaction(function () use ($cartItems, $totalPrice) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // Optional: Reduce stock
                $item->product->decrement('stock_qty', $item->quantity);
            }

            // Clear Cart
            CartItem::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('products.index')->with('success', 'Order placed successfully! The vault is processing your request.');
    }

    /**
     * Admin: Update the order status.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        // If transitioning TO cancelled FROM anything else, restore stock
        if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
            DB::transaction(function () use ($order) {
                foreach ($order->items as $item) {
                    if ($item->product) {
                        $item->product->increment('stock_qty', $item->quantity);
                    }
                }
                $order->update(['status' => 'cancelled']);
            });
            return redirect()->back()->with('success', 'Order cancelled and stock restored to the vault.');
        } 
        
        // If transitioning FROM cancelled TO something else, reduce stock again (optional but good for consistency)
        if ($oldStatus === 'cancelled' && $newStatus !== 'cancelled') {
            DB::transaction(function () use ($order, $newStatus) {
                foreach ($order->items as $item) {
                    if ($item->product) {
                        $item->product->decrement('stock_qty', $item->quantity);
                    }
                }
                $order->update(['status' => $newStatus]);
            });
            return redirect()->back()->with('success', 'Order reactivated and stock adjusted.');
        }

        $order->update(['status' => $newStatus]);

        return redirect()->back()->with('success', 'Order status updated.');
    }
}
