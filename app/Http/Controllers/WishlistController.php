<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $products = Auth::user()->wishlistProducts()->latest()->paginate(12);
        return view('wishlist.index', compact('products'));
    }

    public function toggle(Product $product)
    {
        $user = Auth::user();
        
        if ($user->wishlistProducts()->where('product_id', $product->id)->exists()) {
            $user->wishlistProducts()->detach($product->id);
            $message = 'Product removed from vault wishlist.';
        } else {
            $user->wishlistProducts()->attach($product->id);
            $message = 'Product secured in your vault wishlist.';
        }

        return redirect()->back()->with('success', $message);
    }
}
