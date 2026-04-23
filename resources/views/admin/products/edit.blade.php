@extends('layouts.admin')

@section('admin-content')
<div class="max-w-4xl mx-auto">
    <header class="mb-8">
        <a href="{{ route('admin.products.index') }}" class="text-sm font-bold text-primary hover:underline flex items-center gap-2 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Inventory
        </a>
        <h1 class="text-3xl font-bold tracking-tight text-text">Edit Product</h1>
        <p class="text-text/60">Modifying details for <span class="text-primary font-bold">{{ $product->name }}</span>.</p>
    </header>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-500/10 border-l-4 border-red-500 text-red-700 dark:text-red-400 text-sm rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        @method('PUT')

        <!-- Left: Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-card border border-border rounded-3xl p-8 shadow-xl shadow-primary/5">
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-black text-text/40 uppercase tracking-widest mb-2">Product Name</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}"
                            class="w-full bg-bg border border-border px-5 py-4 rounded-2xl text-text focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all font-medium" required>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-text/40 uppercase tracking-widest mb-2">Description</label>
                        <textarea name="description" rows="5"
                            class="w-full bg-bg border border-border px-5 py-4 rounded-2xl text-text placeholder-text/20 focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all font-medium resize-none">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-xs font-black text-text/40 uppercase tracking-widest mb-2">Price ($)</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" 
                                class="w-full bg-bg border border-border px-5 py-4 rounded-2xl text-text focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all font-medium" required>
                        </div>
                        <div>
                            <label class="block text-xs font-black text-text/40 uppercase tracking-widest mb-2">Discount (%)</label>
                            <input type="number" name="discount_percentage" value="{{ old('discount_percentage', $product->discount_percentage) }}" min="0" max="100" placeholder="0" 
                                class="w-full bg-bg border border-border px-5 py-4 rounded-2xl text-text placeholder-text/40 focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all font-medium">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-text/40 uppercase tracking-widest mb-2">Stock Level</label>
                            <input type="number" name="stock_qty" value="{{ old('stock_qty', $product->stock_qty) }}" 
                                class="w-full bg-bg border border-border px-5 py-4 rounded-2xl text-text focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all font-medium" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Sync -->
            <div class="bg-card border border-border rounded-3xl p-8 shadow-xl shadow-primary/5">
                <label class="block text-xs font-black text-text/40 uppercase tracking-widest mb-4">Update Categories</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @php
                        $activeCategories = $product->categories->pluck('id')->toArray();
                    @endphp
                    @foreach($categories as $category)
                    <label class="relative group cursor-pointer">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="peer hidden" 
                            {{ in_array($category->id, old('categories', $activeCategories)) ? 'checked' : '' }}>
                        <div class="px-4 py-3 bg-bg border border-border rounded-xl text-center transition-all peer-checked:bg-primary/10 peer-checked:border-primary peer-checked:text-primary group-hover:border-primary/30">
                            <span class="text-xs font-bold tracking-tight">{{ $category->name }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right: Current & New Photo -->
        <div class="space-y-6">
            <div class="bg-card border border-border rounded-3xl p-8 shadow-xl shadow-primary/5">
                <label class="block text-xs font-black text-text/40 uppercase tracking-widest mb-4 text-center">Update Photo</label>
                
                <div class="relative group w-full aspect-square bg-bg border-2 border-dashed border-border rounded-2xl overflow-hidden flex flex-col items-center justify-center hover:border-primary/50 transition-all">
                    <input type="file" name="photo" id="photo-input" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                    
                    @if($product->photo)
                        <img id="preview-img" src="{{ asset($product->photo) }}" class="absolute inset-0 w-full h-full object-cover">
                        <div id="upload-placeholder" class="text-center opacity-0 group-hover:opacity-100 bg-bg/80 backdrop-blur-sm absolute inset-0 flex flex-col items-center justify-center transition-all">
                            <svg class="w-8 h-8 text-primary mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                            <p class="text-[9px] font-black uppercase text-primary">Change Image</p>
                        </div>
                    @else
                        <img id="preview-img" src="" class="absolute inset-0 w-full h-full object-cover hidden">
                        <div id="upload-placeholder" class="text-center">
                            <svg class="w-10 h-10 text-text/10 mb-2 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                            <p class="text-[10px] font-black uppercase text-text/30">Upload Image</p>
                        </div>
                    @endif
                </div>
                <p class="mt-4 text-[10px] text-text/40 text-center uppercase tracking-widest">Leave empty to keep current</p>
            </div>

            <button type="submit" class="w-full bg-primary text-white font-bold py-5 rounded-2xl shadow-xl shadow-primary/20 hover:bg-primary-hover hover:-translate-y-0.5 transition-all">
                Update Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="block w-full text-center py-4 bg-bg border border-border text-text font-bold rounded-2xl hover:bg-card transition-all">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('preview-img');
        const placeholder = document.getElementById('upload-placeholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                @if($product->photo)
                    placeholder.classList.remove('group-hover:opacity-100');
                    placeholder.classList.add('opacity-0');
                @else
                    placeholder.classList.add('opacity-0');
                @endif
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
