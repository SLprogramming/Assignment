@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <nav class="flex mb-8 animate-in fade-in slide-in-from-left duration-500" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/" class="text-sm font-medium text-text/40 hover:text-primary transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-text/20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <a href="/products" class="ml-1 text-sm font-medium text-text/40 hover:text-primary transition-colors md:ml-2">Products</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-text/20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-1 text-sm font-black text-primary md:ml-2">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20">
        <!-- Image Section -->
        <div class="animate-in fade-in slide-in-from-left duration-700">
            <div class="relative group aspect-square rounded-[3rem] overflow-hidden bg-card border border-border shadow-2xl">
                @if($product->photo)
                    <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">
                @else
                    <div class="flex flex-col items-center justify-center h-full text-text/5 gap-4">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                        <span class="text-sm font-bold uppercase tracking-widest text-text/20">No Image Available</span>
                    </div>
                @endif
                <div class="absolute top-8 left-8">
                    @foreach($product->categories as $category)
                        <span class="px-4 py-2 bg-primary/90 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-full backdrop-blur-md shadow-xl mb-2 inline-block">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Info Section -->
        <div class="flex flex-col justify-center animate-in fade-in slide-in-from-bottom duration-700 delay-200">
            <div class="mb-8">
                <span class="text-primary text-xs font-black uppercase tracking-[0.3em] mb-4 block">Limited Edition Stock</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-text tracking-tight mb-4 leading-tight">
                    {{ $product->name }}
                </h1>
                <div class="flex items-center gap-6">
                    @if($product->discount_percentage > 0)
                        <div class="flex flex-col items-start leading-none h-full justify-center">
                            <span class="text-xl font-bold text-text/40 line-through mb-1">${{ number_format($product->price, 2) }}</span>
                            <span class="text-4xl font-black text-primary">${{ number_format($product->price - ($product->price * ($product->discount_percentage / 100)), 2) }}</span>
                        </div>
                    @else
                        <span class="text-4xl font-black text-primary">${{ number_format($product->price, 2) }}</span>
                    @endif
                    <div class="h-6 w-px bg-border"></div>
                    <span class="text-sm font-bold text-text/40 uppercase tracking-widest">
                        SKU: FLN-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}
                    </span>
                </div>
            </div>

            <div class="space-y-8 mb-10">
                <div class="p-6 bg-primary/5 border border-primary/10 rounded-3xl">
                    <div class="flex items-center gap-4 mb-3">
                        <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h3 class="font-black text-text uppercase tracking-widest text-sm">Product Availability</h3>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-text/60 font-medium">Currently in vault</span>
                        <span class="px-4 py-1.5 rounded-full bg-bg border border-border text-xs font-black text-text flex items-center gap-2">
                             <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                            </span>
                            {{ $product->stock_qty }} Units Left
                        </span>
                    </div>
                </div>

                <div class="space-y-3">
                    <h3 class="font-black text-text uppercase tracking-widest text-xs">Description</h3>
                    <p class="text-text/60 text-lg leading-relaxed font-medium italic whitespace-pre-line">
                        @if($product->description)
                            {{ $product->description }}
                        @else
                            Experience the pinnacle of craftsmanship with the {{ $product->name }}. Meticulously designed for those who appreciate the finer details, this piece seamlessly blends timeless aesthetic with modern functionality. Every curve and finish has been optimized for the ultimate sensory experience.
                        @endif
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">
                <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col sm:flex-row gap-4 flex-1">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="flex items-center bg-card border border-border rounded-2xl h-[4.5rem]">
                        <button type="button" onclick="decrementQty()" class="w-12 h-full flex items-center justify-center text-text/40 hover:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                        </button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock_qty }}" 
                            class="w-16 bg-transparent text-center font-black text-lg text-text border-none focus:ring-0 appearance-none pointer-events-none" readonly>
                        <button type="button" onclick="incrementQty()" class="w-12 h-full flex items-center justify-center text-text/40 hover:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </button>
                    </div>

                    <script>
                        function incrementQty() {
                            const input = document.getElementById('quantity');
                            const max = parseInt(input.getAttribute('max'));
                            if (parseInt(input.value) < max) {
                                input.value = parseInt(input.value) + 1;
                            }
                        }
                        function decrementQty() {
                            const input = document.getElementById('quantity');
                            if (parseInt(input.value) > 1) {
                                input.value = parseInt(input.value) - 1;
                            }
                        }
                    </script>

                    <button type="submit" class="flex-1 px-10 py-6 bg-primary text-white font-black uppercase tracking-[0.2em] rounded-2xl shadow-2xl shadow-primary/30 hover:bg-primary-hover hover:scale-[1.02] active:scale-95 transition-all duration-300 flex items-center justify-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Add to Cart
                    </button>
                </form>
                <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-8 py-6 rounded-2xl transition-all duration-300 {{ auth()->check() && auth()->user()->wishlistProducts()->where('product_id', $product->id)->exists() ? 'bg-primary text-white shadow-xl shadow-primary/30' : 'bg-card border border-border text-text hover:bg-bg' }}">
                        <svg class="w-6 h-6" fill="{{ auth()->check() && auth()->user()->wishlistProducts()->where('product_id', $product->id)->exists() ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </button>
                </form>
            </div>

            <!-- Features -->
            <div class="mt-12 grid grid-cols-3 gap-4 border-t border-border pt-12">
                <div class="text-center">
                    <div class="text-primary font-black text-lg mb-1">24h</div>
                    <div class="text-[10px] text-text/40 font-bold uppercase tracking-widest">Fast Delivery</div>
                </div>
                <div class="text-center border-x border-border">
                    <div class="text-primary font-black text-lg mb-1">100%</div>
                    <div class="text-[10px] text-text/40 font-bold uppercase tracking-widest">Original</div>
                </div>
                <div class="text-center">
                    <div class="text-primary font-black text-lg mb-1">Ethical</div>
                    <div class="text-[10px] text-text/40 font-bold uppercase tracking-widest">Source</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Section (Placeholder for aesthetic) -->
    <section class="mt-32 pt-24 border-t border-border/50">
        <div class="flex items-center justify-between mb-12">
            <h2 class="text-3xl font-black text-text italic">The Vault Selection</h2>
            <a href="/products" class="text-xs font-black text-primary uppercase tracking-widest hover:underline decoration-2 underline-offset-8">Explore More →</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($relatedProducts as $related)
                <a href="{{ route('products.show', $related) }}" class="group relative bg-card border border-border rounded-[2rem] overflow-hidden hover:-translate-y-2 hover:shadow-2xl transition-all duration-500">
                    <div class="aspect-[4/5] bg-bg/50 relative overflow-hidden">
                        @if($related->photo)
                            <img src="{{ asset($related->photo) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $related->name }}">
                        @else
                            <div class="flex items-center justify-center h-full text-text/5">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 flex flex-col items-center text-center">
                        <span class="text-text font-bold text-sm truncate w-full mb-1">{{ $related->name }}</span>
                        @if($related->discount_percentage > 0)
                            <div class="flex items-center gap-2">
                                <span class="text-text/40 font-bold text-[10px] line-through">${{ number_format($related->price, 2) }}</span>
                                <span class="text-primary font-black text-sm">${{ number_format($related->price - ($related->price * ($related->discount_percentage / 100)), 2) }}</span>
                            </div>
                        @else
                            <span class="text-primary font-black text-sm">${{ number_format($related->price, 2) }}</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </section>
</div>
@endsection
