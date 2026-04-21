@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <header class="mb-12 animate-in fade-in slide-in-from-bottom duration-700">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-[0.2em] mb-4">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path></svg>
            Personal Vault
        </div>
        <h1 class="text-4xl md:text-6xl font-black text-text tracking-tight italic">Your Wishlist</h1>
        <p class="text-text/60 mt-4 max-w-2xl font-medium leading-relaxed">
            A curated selection of your favorite pieces from the Flannel Vault. Secured and ready for your next acquisition.
        </p>
    </header>

    @if($products->isEmpty())
        <div class="py-32 text-center bg-card border border-dashed border-border rounded-[4rem] animate-in zoom-in duration-500">
            <div class="w-20 h-20 bg-primary/5 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-10 h-10 text-text/10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </div>
            <p class="text-text/40 font-black text-xl uppercase tracking-widest">Your wishlist is currently empty.</p>
            <p class="text-text/20 mt-2 font-medium mb-10">Discover something special to secure in your vault.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-primary text-white font-black uppercase tracking-widest rounded-2xl hover:bg-primary-hover hover:scale-105 transition-all shadow-xl shadow-primary/20">
                Explore Vault
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
                <div class="group relative bg-card border border-border rounded-[2.5rem] overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-2">
                    <div class="aspect-[4/5] bg-bg/50 relative overflow-hidden">
                        @if($product->photo)
                            <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="flex items-center justify-center h-full text-text/5">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                            </div>
                        @endif

                        <!-- Remove From Wishlist Button -->
                        <div class="absolute top-4 right-4 z-10">
                            <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-3 bg-red-500 text-white rounded-full shadow-lg shadow-red-500/30 hover:scale-110 transition-all duration-300">
                                    <svg class="w-4 h-4" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="font-bold text-text text-lg line-clamp-1 truncate mb-1">{{ $product->name }}</h3>
                        <p class="text-primary font-black text-xl mb-4">${{ number_format($product->price, 2) }}</p>

                        <div class="flex items-center gap-3">
                            <a href="{{ route('products.show', $product) }}" class="flex-1 py-3 bg-primary/5 text-primary text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-primary hover:text-white transition-all text-center">
                                Details
                            </a>
                            <form action="{{ route('cart.add') }}" method="POST" class="flex-none">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="p-3 bg-bg border border-border text-text/70 rounded-xl hover:text-primary hover:border-primary/30 transition-all group">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
