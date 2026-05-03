@extends('layouts.admin')

@section('admin-content')
<header class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-text">Product Management</h1>
        <p class="text-text/60">Manage your inventory and product listings.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="px-6 py-3 bg-primary text-white font-semibold rounded-2xl shadow-lg shadow-primary/20 hover:bg-primary-hover transition-all flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add New Product
    </a>
</header>

<!-- Filters -->
<form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col md:flex-row gap-4 mb-8">
    <div class="flex-1 relative flex">
        <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-text/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="w-full bg-card border border-border pl-12 pr-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all text-text">
    </div>
    <div class="flex gap-2">
        <button type="submit" class="px-6 py-3 bg-primary text-white font-semibold rounded-2xl hover:bg-primary-hover shadow-lg shadow-primary/20 transition-all">
            Search
        </button>
        @if(request('search'))
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-card border border-border text-text font-semibold rounded-2xl hover:bg-bg transition-all flex items-center">
                Clear
            </a>
        @endif
    </div>
</form>

<!-- Products Table -->
<div class="bg-card border border-border rounded-3xl overflow-hidden shadow-sm shadow-primary/5">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-bg/50 text-text/50 text-xs uppercase tracking-widest border-b border-border">
                <th class="px-8 py-4 font-semibold text-[10px]">Product / INFO</th>
                <th class="px-8 py-4 font-semibold text-center text-[10px]">Categories</th>
                <th class="px-8 py-4 font-semibold text-center text-[10px]">Price</th>
                <th class="px-8 py-4 font-semibold text-center text-[10px]">Discount</th>
                <th class="px-8 py-4 font-semibold text-center text-[10px]">Stock</th>
                <th class="px-8 py-4 font-semibold text-right text-[10px]">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-border/50">
            @forelse($products as $product)
            <tr class="hover:bg-bg/40 transition-colors group">
                <td class="px-8 py-5">
                    <div class="flex items-center gap-4">
                        @if($product->photo)
                            <img src="{{ asset($product->photo) }}" 
                                onclick="openImageModal(this.src)"
                                class="w-14 h-14 rounded-xl object-cover border border-border shadow-sm group-hover:scale-110 cursor-zoom-in transition-transform" 
                                alt="{{ $product->name }}">
                        @else
                            <div class="w-14 h-14 bg-bg rounded-xl flex items-center justify-center text-text/10 border border-border">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                            </div>
                        @endif
                        <div>
                            <p class="font-bold text-text mb-0.5">{{ $product->name }}</p>
                            <p class="text-[10px] text-text/30 font-medium tracking-tighter uppercase">ID: #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-8 py-5 text-center">
                    <div class="flex flex-wrap justify-center gap-1.5">
                        @forelse($product->categories as $category)
                            <span class="px-2.5 py-1 bg-primary/5 text-primary text-[10px] font-black uppercase tracking-widest rounded-md border border-primary/10">
                                {{ $category->name }}
                            </span>
                        @empty
                            <span class="text-[10px] text-text/20 italic font-medium">Uncategorized</span>
                        @endforelse
                    </div>
                </td>
                <td class="px-8 py-5 text-center font-black text-text">${{ number_format($product->price, 2) }}</td>
                <td class="px-8 py-5 text-center text-[13px] text-text/30 ">{{ $product->discount_percentage ?? "0" }}%</td>
                <td class="px-8 py-5 text-center">
                    @if($product->stock_qty > 0)
                        <span class="text-sm font-bold text-text/70">{{ $product->stock_qty }} <span class="text-[10px] text-text/30 uppercase font-black">units</span></span>
                    @else
                        <span class="px-2.5 py-1 bg-red-500/10 text-red-500 text-[10px] font-black uppercase tracking-widest rounded-md border border-red-500/20">Out of Stock</span>
                    @endif
                </td>
                <td class="px-8 py-5 text-right">
                    <div class="flex items-center justify-end gap-1.5">
                        <a href="{{ route('admin.products.edit', $product) }}" class="p-2.5 bg-bg border border-border text-text/40 hover:text-primary hover:border-primary/30 rounded-xl transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product permanently?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2.5 bg-bg border border-border text-text/40 hover:text-red-500 hover:border-red-500/30 rounded-xl transition-all shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-8 py-12 text-text text-center">
                    <div class="flex flex-col items-center justify-center opacity-40">
                         <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                         <p class="font-bold text-lg">No Products Found</p>
                         <p class="text-sm">Start by adding your first premium item.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($products->total() > 0)
<div class="mt-8 flex flex-col md:flex-row items-center justify-between gap-6 px-4">
    <p class="text-[10px] text-text/30 font-black uppercase tracking-widest order-2 md:order-1">
        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products
    </p>
    <div class="order-1 md:order-2">
        {{ $products->links() }}
    </div>
</div>
@endif
@endsection

<!-- Image Viewer Modal -->
<div id="image-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="fixed inset-0 bg-bg/90 backdrop-blur-xl transition-opacity animate-in fade-in duration-300" onclick="closeImageModal()"></div>
    
    <div class="relative z-10 max-w-5xl w-full flex flex-col items-center">
        <button onclick="closeImageModal()" class="absolute -top-12 right-0 p-2 text-text/60 hover:text-primary transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        
        <img id="modal-img" src="" class="max-w-full max-h-[85vh] rounded-3xl shadow-2xl border border-border animate-in zoom-in-95 duration-300">
    </div>
</div>

@push('scripts')
<script>
    const modal = document.getElementById('image-modal');
    const modalImg = document.getElementById('modal-img');

    function openImageModal(src) {
        modalImg.src = src;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    function closeImageModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = ''; // Restore scrolling
    }

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeImageModal();
    });
</script>
@endpush
