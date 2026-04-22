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
    <section class="mb-20 p-12 lg:p-20 bg-primary/5 border border-primary/10 rounded-[4rem] text-center relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-primary/10 blur-[100px] -translate-y-1/2 translate-x-1/2 rounded-full"></div>
        <div class="relative z-10 max-w-2xl mx-auto">
            <h2 class="text-4xl font-black text-text mb-6 italic">Join the Vault</h2>
            <p class="text-text/60 text-lg mb-10 font-medium leading-relaxed">Create your exclusive account today to unlock member pricing, rapid checkout, and complete order history tracking.</p>
            <form action="{{ route('register') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <input type="email" name="email" placeholder="Enter your email address..." class="flex-1 px-8 py-5 bg-card border border-border rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary/50 text-text font-medium" required>
                <button type="submit" class="px-10 py-5 bg-text text-bg dark:bg-primary dark:text-white font-bold rounded-2xl hover:scale-105 transition-all duration-300">Register</button>
            </form>
        </div>
    </section>
</div>
@endsection
