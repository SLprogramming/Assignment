@extends('layouts.app')

@section('content')
<div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <section class="py-5 text-center border-b border-border/50 mb-10 animate-in fade-in slide-in-from-bottom-10 duration-700">
        <div class="max-w-4xl mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary text-xs font-black uppercase tracking-widest mb-8 border border-primary/20">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                </span>
                New Season Collection 2026
            </div>
            <h1 class="text-3xl sm:text-6xl lg:text-8xl font-black tracking-tight text-text leading-[1.1] sm:leading-[0.9] mb-6 sm:mb-8 px-2">
                Elevate Your <span class="bg-gradient-to-r from-primary via-primary to-secondary bg-clip-text text-transparent italic pe-3">Lifestyle</span>
            </h1>
            <p class="text-base sm:text-xl text-text/60 font-medium leading-relaxed mb-8 sm:mb-12 max-w-2xl mx-auto px-4">
                Discover our curated collection of premium essentials designed for modern living. Quality meets aesthetic in every individual piece.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center px-4 w-full sm:w-auto mx-auto lg:mx-0">
                <a href="{{ route('products.index') }}" class="w-full sm:w-auto px-10 py-5 bg-primary text-white font-bold rounded-2xl shadow-2xl shadow-primary/30 hover:bg-primary-hover hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                    Shop Now
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
                <a href="#latest" class="w-full sm:w-auto px-10 py-5 bg-card border border-border text-text font-bold rounded-2xl hover:bg-bg transition-all duration-300">
                    Latest Arrivals
                </a>
            </div>
        </div>
    </section>

    <!-- Latest Items Section -->
    <section id="latest" class="pb-32 animate-in fade-in slide-in-from-bottom-20 duration-1000 delay-300">
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-8 px-2">
            <div>
                <span class="text-[8px] sm:text-[10px] font-black text-primary uppercase tracking-[0.3em] mb-1 sm:mb-2 block">New In Stock</span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight text-text">Latest Arrivals</h2>
            </div>
            <a href="/products" class="group flex items-center gap-2 text-text/30 text-xs font-bold hover:text-primary transition-all mb-1">
                View All Products 
                <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>
        </div>

        <!-- Quick Category Shortcuts -->
        <!-- <div class="flex items-center justify-start gap-4 overflow-x-auto pb-10 mb-4 px-8 flex-nowrap max-w-full">
            <span class="text-[10px] font-black text-text/20 uppercase tracking-widest mr-4 whitespace-nowrap flex-shrink-0">Filter:</span>
            <a href="{{ route('products.index') }}" class="flex-shrink-0 px-6 py-2.5 bg-primary/5 border border-primary/10 text-primary text-[10px] font-black uppercase tracking-widest rounded-full hover:bg-primary hover:!text-white transition-all whitespace-nowrap">All</a>
            @foreach(\App\Models\Category::all() as $cat)
                <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="flex-shrink-0 px-6 py-2.5 bg-card border border-border text-text/40 text-[10px] font-black uppercase tracking-widest rounded-full hover:border-primary/30 hover:text-primary transition-all whitespace-nowrap">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div> -->

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6">
            @forelse($latestProducts as $product)
                <div class="group relative bg-card border border-border rounded-2xl sm:rounded-3xl overflow-hidden transition-all duration-500 hover:shadow-xl hover:-translate-y-1">
                    <div class="aspect-square bg-bg/50 relative overflow-hidden">
                        @if($product->photo)
                            <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="flex items-center justify-center h-full text-text/5">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                            </div>
                        @endif
                        <div class="absolute top-2 left-2 sm:top-3 sm:left-3">
                            <span class="px-1.5 py-0.5 sm:px-2 bg-primary text-white text-[7px] sm:text-[8px] font-black uppercase tracking-widest rounded-full shadow-lg shadow-primary/20">New</span>
                        </div>
                        <div class="absolute top-2 right-2 sm:top-3 sm:right-3">
                            <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 rounded-full backdrop-blur-md transition-all duration-300 {{ auth()->check() && auth()->user()->wishlistProducts()->where('product_id', $product->id)->exists() ? 'bg-primary text-white' : 'bg-white/20 text-white hover:bg-white/40' }}">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="{{ auth()->check() && auth()->user()->wishlistProducts()->where('product_id', $product->id)->exists() ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="p-3 sm:p-5">
                        <h3 class="font-bold text-text text-[11px] sm:text-sm line-clamp-1 mb-1">{{ $product->name }}</h3>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-3 sm:mb-4">
                            <span class="text-xs sm:text-sm font-black text-text">${{ number_format($product->price, 2) }}</span>
                            <span class="text-[8px] sm:text-[10px] text-text/30 font-bold uppercase tracking-tight italic">Stock: {{ $product->stock_qty }}</span>
                        </div>
                        <a href="{{ route('products.show', $product) }}" class="w-full inline-flex items-center justify-center py-2 bg-primary/5 text-primary text-[9px] sm:text-[10px] font-black uppercase tracking-widest rounded-lg sm:rounded-xl hover:bg-primary hover:!text-white transition-all duration-200">
                            Details
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-24 text-center bg-bg/5 border border-dashed border-border rounded-[3rem]">
                    <p class="text-text/40 font-bold text-lg uppercase tracking-widest">No items in the vault yet.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Newsletter/CTA Section -->
    <!-- Flash Sale Section -->
    @php
        $flashSaleProducts = \App\Models\Product::whereNotNull('discount_percentage')->where('discount_percentage', '>', 0)->inRandomOrder()->take(10)->get();
    @endphp
    <section class="mb-20 animate-in fade-in slide-in-from-bottom duration-1000 delay-500">
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-8 px-2">
            <div>
                <span class="text-[8px] sm:text-[10px] font-black text-red-500 uppercase tracking-[0.3em] mb-1 sm:mb-2 flex items-center gap-2">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                    </span>
                    Limited Time Offer
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight text-text">Flash Sale</h2>
            </div>
            @if($flashSaleProducts->isNotEmpty())
            <div class="flex items-center gap-2 px-4 py-2 bg-red-500/10 text-red-500 rounded-full border border-red-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-xs font-bold font-mono uppercase tracking-widest">Ends Soon</span>
            </div>
            @endif
        </div>

        @if($flashSaleProducts->isNotEmpty())
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6">
                @foreach($flashSaleProducts as $product)
                    <div class="group relative bg-card border border-red-500/20 rounded-2xl sm:rounded-3xl overflow-hidden transition-all duration-500 hover:shadow-xl hover:shadow-red-500/10 hover:-translate-y-1">
                        <div class="aspect-square bg-bg/50 relative overflow-hidden">
                            @if($product->photo)
                                <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="flex items-center justify-center h-full text-text/5">
                                    <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-2 left-2 sm:top-3 sm:left-3">
                                <span class="px-1.5 py-0.5 sm:px-2 bg-red-500 text-white text-[7px] sm:text-[8px] font-black uppercase tracking-widest rounded-full shadow-lg shadow-red-500/20">-{{ $product->discount_percentage }}%</span>
                            </div>
                            <div class="absolute top-2 right-2 sm:top-3 sm:right-3">
                                <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-full backdrop-blur-md transition-all duration-300 {{ auth()->check() && auth()->user()->wishlistProducts()->where('product_id', $product->id)->exists() ? 'bg-primary text-white' : 'bg-white/20 text-white hover:bg-white/40' }}">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="{{ auth()->check() && auth()->user()->wishlistProducts()->where('product_id', $product->id)->exists() ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="p-3 sm:p-5">
                            <h3 class="font-bold text-text text-[11px] sm:text-sm line-clamp-1 mb-1">{{ $product->name }}</h3>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-3 sm:mb-4 gap-1">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs sm:text-sm font-black text-red-500">${{ number_format($product->price * (1 - $product->discount_percentage / 100), 2) }}</span>
                                    <span class="text-[9px] sm:text-[10px] text-text/40 line-through">${{ number_format($product->price, 2) }}</span>
                                </div>
                            </div>
                            <a href="{{ route('products.show', $product) }}" class="w-full inline-flex items-center justify-center py-2 bg-red-500/5 text-red-600 text-[9px] sm:text-[10px] font-black uppercase tracking-widest rounded-lg sm:rounded-xl hover:bg-red-500 hover:!text-white transition-all duration-200 border border-red-500/10">
                                Snap It Up
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-16 px-4 text-center bg-card border border-dashed border-red-500/20 rounded-[3rem]">
                <div class="w-16 h-16 mx-auto bg-red-500/5 rounded-2xl flex items-center justify-center mb-4 text-red-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-xl font-black text-text mb-2 uppercase tracking-widest">Discount Items Coming Soon</h3>
                <p class="text-text/60 font-medium">Our vault curators are currently preparing fresh deals. Check back shortly!</p>
            </div>
        @endif
    </section>
</div>

    <!-- Premium Footer -->
    <footer class="w-full bg-card border-t border-border mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Brand -->
                <div class="space-y-6">
                    <h3 class="text-3xl font-black tracking-tighter text-text">
                        SHOP<span class="text-primary">.</span>
                    </h3>
                    <p class="text-text/60 text-sm font-medium leading-relaxed max-w-xs">
                        Elevating modern lifestyles through curated premium essentials. Experience the difference.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="p-3 bg-bg border border-border rounded-xl text-text hover:text-white hover:bg-primary hover:border-primary transition-all duration-300 shadow-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="p-3 bg-bg border border-border rounded-xl text-text hover:text-white hover:bg-primary hover:border-primary transition-all duration-300 shadow-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Shop Links -->
                <div class="space-y-6 lg:pl-10">
                    <h4 class="text-sm font-black text-text uppercase tracking-widest">Shop</h4>
                    <div class="flex flex-col space-y-4">
                        <a href="{{ route('products.index') }}" class="text-text/60 text-sm font-medium hover:text-primary transition-colors">All Products</a>
                        <a href="#latest" class="text-text/60 text-sm font-medium hover:text-primary transition-colors">New Arrivals</a>
                        <a href="#" class="text-text/60 text-sm font-medium hover:text-primary transition-colors">Collections</a>
                        <a href="#" class="text-text/60 text-sm font-medium hover:text-primary transition-colors">Gift Cards</a>
                    </div>
                </div>

                <!-- Support -->
                <div class="space-y-6">
                    <h4 class="text-sm font-black text-text uppercase tracking-widest">Support</h4>
                    <div class="flex flex-col space-y-4">
                        <a href="#" class="text-text/60 text-sm font-medium hover:text-primary transition-colors">FAQ</a>
                        <a href="#" class="text-text/60 text-sm font-medium hover:text-primary transition-colors">Shipping & Returns</a>
                        <a href="#" class="text-text/60 text-sm font-medium hover:text-primary transition-colors">Track Order</a>
                        <a href="#" class="text-text/60 text-sm font-medium hover:text-primary transition-colors">Contact Us</a>
                    </div>
                </div>

                <!-- About -->
                <div class="space-y-6">
                    <h4 class="text-sm font-black text-text uppercase tracking-widest">About</h4>
                    <div class="flex flex-col space-y-4">
                        <a href="#" class="text-text/60 text-sm font-medium hover:text-primary transition-colors">Our Story</a>
                        <a href="#" class="text-text/60 text-sm font-medium hover:text-primary transition-colors">Sustainability</a>
                        <a href="#" class="text-text/60 text-sm font-medium hover:text-primary transition-colors">Journal</a>
                        <a href="#" class="text-text/60 text-sm font-medium hover:text-primary transition-colors">Careers</a>
                    </div>
                </div>
            </div>

            <div class="mt-16 pt-8 border-t border-border flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-text/40 text-[10px] font-bold uppercase tracking-widest">
                    &copy; {{ date('Y') }} SHOP. All rights reserved.
                </p>
                <div class="flex gap-6">
                    <a href="#" class="text-text/40 text-[10px] font-bold uppercase tracking-widest hover:text-primary transition-all">Privacy Policy</a>
                    <a href="#" class="text-text/40 text-[10px] font-bold uppercase tracking-widest hover:text-primary transition-all">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
@endsection
