@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-12">
        <h1 class="text-4xl md:text-5xl font-black text-text tracking-tight italic">
            Your <span class="text-primary text-not-italic">Vault</span> Selection
        </h1>
        <a href="{{ route('products.index') }}" class="text-sm font-black text-primary uppercase tracking-[0.2em] hover:underline decoration-2 underline-offset-8">
            ← Keep Exploring
        </a>
    </div>

    @if($cartItems->isEmpty())
        <div class="bg-card border border-dashed border-border rounded-[3rem] py-24 flex flex-col items-center justify-center text-center animate-in fade-in zoom-in duration-500">
            <div class="w-24 h-24 bg-primary/5 rounded-full flex items-center justify-center text-primary/20 mb-6">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <h2 class="text-2xl font-black text-text/40 uppercase tracking-widest mb-2">Vault is Empty</h2>
            <p class="text-text/20 font-medium mb-8">You haven't secured any items yet.</p>
            <a href="{{ route('products.index') }}" class="px-10 py-5 bg-primary text-white font-black uppercase tracking-[0.2em] rounded-2xl shadow-2xl shadow-primary/30 hover:scale-105 transition-all">
                Browse Collection
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Items Section -->
            <div class="lg:col-span-2 space-y-6">
                @foreach($cartItems as $item)
                    <div class="group bg-card border border-border rounded-[2.5rem] p-6 transition-all duration-500 hover:shadow-2xl hover:shadow-primary/5 flex items-center gap-8 relative overflow-hidden">
                        <!-- Background Accent -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-[5rem] -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700"></div>

                        <!-- Product Image -->
                        <div class="relative w-32 h-32 rounded-3xl overflow-hidden bg-bg border border-border flex-shrink-0">
                            @if($item->product->photo)
                                <img src="{{ asset($item->product->photo) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-text/5">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4 mb-2">
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-xl font-black text-text line-clamp-2 group-hover:text-primary transition-colors leading-tight mb-1" title="{{ $item->product->name }}">
                                        {{ $item->product->name }}
                                    </h3>
                                    <p class="text-xs font-bold text-text/30 uppercase tracking-widest">SKU: FLN-{{ str_pad($item->product->id, 4, '0', STR_PAD_LEFT) }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xl font-black text-primary whitespace-nowrap">${{ number_format($item->product->discounted_price * $item->quantity, 2) }}</span>
                                    @if($item->product->discount_percentage)
                                        <p class="text-[10px] text-red-500 font-bold uppercase tracking-widest mt-1">{{ $item->product->discount_percentage }}% Discount Applied</p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-center gap-6 mt-6">
                                <!-- Quantity Control -->
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center bg-bg border border-border rounded-xl px-2 h-10">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}" class="w-8 h-8 flex items-center justify-center text-text/40 hover:text-primary transition-colors disabled:opacity-20" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                    </button>
                                    <input type="text" value="{{ $item->quantity }}" readonly class="w-10 bg-transparent text-center font-black text-sm text-text border-none focus:ring-0">
                                    <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" class="w-8 h-8 flex items-center justify-center text-text/40 hover:text-primary transition-colors disabled:opacity-20" {{ $item->quantity >= $item->product->stock_qty ? 'disabled' : '' }}>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </button>
                                </form>

                                <!-- Remove -->
                                <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-black text-text/20 uppercase tracking-widest hover:text-red-500 transition-colors flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary Section -->
            <div class="lg:col-span-1">
                <div class="sticky top-32 bg-card border border-border rounded-[3rem] p-8 shadow-2xl shadow-primary/5 overflow-hidden relative">
                     <!-- Background Glow -->
                     <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-primary/10 blur-[100px] rounded-full"></div>

                    <h3 class="text-2xl font-black text-text mb-8 italic">Order Summary</h3>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-sm">
                            <span class="text-text/40 font-bold uppercase tracking-widest">Subtotal</span>
                            <span class="text-text font-black">${{ number_format($cartItems->sum(fn($i) => $i->product->discounted_price * $i->quantity), 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-text/40 font-bold uppercase tracking-widest">Shipping</span>
                            <span class="text-primary font-black uppercase tracking-tight">Complimentary</span>
                        </div>
                        <div class="h-px bg-border my-6"></div>
                        <div class="flex justify-between items-end">
                            <span class="text-xs font-bold text-text/40 uppercase tracking-[0.2em]">Total Amount</span>
                            <span class="text-4xl font-black text-primary tracking-tighter">${{ number_format($cartItems->sum(fn($i) => $i->product->discounted_price * $i->quantity), 2) }}</span>
                        </div>
                    </div>

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-6 bg-primary text-white font-black uppercase tracking-[0.2em] rounded-2xl shadow-2xl shadow-primary/30 hover:bg-primary-hover hover:scale-[1.02] active:scale-95 transition-all duration-300 flex items-center justify-center gap-3">
                            Secure Checkout
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>

                    <div class="mt-8 flex items-center justify-center gap-4 opacity-20 filter grayscale">
                        <svg class="h-6" viewBox="0 0 38 24" fill="none"><rect width="38" height="24" rx="4" fill="#252525"/><path d="M12 12h14" stroke="white" stroke-width="2"/></svg>
                        <svg class="h-6" viewBox="0 0 38 24" fill="none"><rect width="38" height="24" rx="4" fill="#252525"/><path d="M12 12h14" stroke="white" stroke-width="2"/></svg>
                        <svg class="h-6" viewBox="0 0 38 24" fill="none"><rect width="38" height="24" rx="4" fill="#252525"/><path d="M12 12h14" stroke="white" stroke-width="2"/></svg>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
