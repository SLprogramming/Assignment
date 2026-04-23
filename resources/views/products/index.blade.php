@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <header class="mb-10 text-center animate-in fade-in slide-in-from-bottom duration-700">
        <span class="text-primary text-xs font-black uppercase tracking-[0.3em] mb-4 block">Our Curated Collection</span>
        <h1 class="text-4xl md:text-6xl font-black text-text tracking-tight mb-6 italic">The ShopNest Vault</h1>
        <p class="text-text/60 max-w-2xl mx-auto font-medium leading-relaxed">
            Explore our meticulously curated selection of premium essentials. Each piece in our vault is chosen for its exceptional quality and timeless aesthetic.
        </p>
    </header>

    <!-- Category Filter Bar -->
    <div class="mb-12 animate-in fade-in slide-in-from-bottom duration-700 delay-200 w-full">
        <div class="flex items-center justify-start gap-4 overflow-x-auto pb-6 px-8 flex-nowrap w-full">
            <a href="{{ route('products.index') }}" 
               class="flex-shrink-0 px-8 py-3 rounded-2xl whitespace-nowrap text-xs font-black uppercase tracking-widest transition-all duration-300 {{ !request('category') ? 'bg-primary text-white shadow-xl shadow-primary/20 scale-105' : 'bg-card border border-border text-text/50 hover:border-primary/30 hover:text-primary' }}">
                All Collections
            </a>
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
                   class="flex-shrink-0 px-8 py-3 rounded-2xl whitespace-nowrap text-xs font-black uppercase tracking-widest transition-all duration-300 {{ request('category') == $category->slug || request('category') == $category->id ? 'bg-primary text-white shadow-xl shadow-primary/20 scale-105' : 'bg-card border border-border text-text/50 hover:border-primary/30 hover:text-primary' }}">
                    {{ $category->name }}
                    <span class="ml-1 text-[8px] opacity-50">({{ $category->products_count }})</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @forelse($products as $product)
            <div class="group relative bg-card border border-border rounded-[2.5rem] overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-2">
                <div class="aspect-[4/5] bg-bg/50 relative overflow-hidden">
                    @if($product->photo)
                        <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="flex items-center justify-center h-full text-text/5">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                        </div>
                    @endif
                    
                    <div class="absolute top-4 left-4 z-10">
                        <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-3 rounded-full backdrop-blur-md transition-all duration-300 {{ auth()->check() && auth()->user()->wishlistProducts()->where('product_id', $product->id)->exists() ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'bg-white/20 text-white hover:bg-white/40' }}">
                                <svg class="w-4 h-4" fill="{{ auth()->check() && auth()->user()->wishlistProducts()->where('product_id', $product->id)->exists() ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Quick Add Badge -->
                    <div class="absolute inset-x-4 bottom-4 translate-y-12 group-hover:translate-y-0 transition-transform duration-500">
                        <a href="{{ route('products.show', $product) }}" class="w-full py-3 bg-white/90 backdrop-blur-md text-black text-xs font-black uppercase tracking-widest rounded-2xl shadow-xl flex items-center justify-center gap-2 hover:bg-white transition-colors">
                            View Details
                        </a>
                    </div>

                    @if($product->stock_qty < 5 && $product->stock_qty > 0)
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 bg-secondary text-white text-[8px] font-black uppercase tracking-widest rounded-full shadow-lg">Low Stock</span>
                        </div>
                    @endif
                </div>

                <div class="p-6">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="font-bold text-text text-lg line-clamp-1 truncate pe-2">{{ $product->name }}</h3>
                        <span class="text-primary font-black text-lg">${{ number_format($product->price, 2) }}</span>
                    </div>
                    
                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach($product->categories as $category)
                            <span class="text-[9px] text-text/30 font-bold uppercase tracking-tight">{{ $category->name }}@if(!$loop->last), @endif</span>
                        @endforeach
                    </div>

                    <div class="h-px bg-border/50 mb-4 w-full"></div>

                    <div class="flex items-center justify-between">
                        <span class="text-[10px] text-text/40 font-bold uppercase tracking-widest flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full {{ $product->stock_qty > 0 ? 'bg-primary animate-pulse' : 'bg-red-500' }}"></span>
                            {{ $product->stock_qty > 0 ? 'Available' : 'Sold Out' }}
                        </span>
                        <a href="{{ route('products.show', $product) }}" class="p-2 text-text/20 hover:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-32 text-center bg-card border border-dashed border-border rounded-[4rem]">
                 <svg class="w-16 h-16 mx-auto mb-6 text-text/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <p class="text-text/40 font-black text-xl uppercase tracking-widest">Our vault is currently empty.</p>
                <p class="text-text/20 mt-2 font-medium">Check back soon for new arrivals.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-20">
        {{ $products->links() }}
    </div>
</div>
@endsection
