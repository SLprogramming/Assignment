@extends('layouts.admin')

@section('admin-content')
<header class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-text">Category Management</h1>
        <p class="text-text/60">Organize your products into meaningful groups.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="px-6 py-3 bg-primary text-white font-semibold rounded-2xl shadow-lg shadow-primary/20 hover:bg-primary-hover transition-all flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        New Category
    </a>
</header>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($categories as $category)
    <!-- Category Card -->
    <div class="p-8 bg-card border border-border rounded-3xl hover:shadow-xl hover:shadow-primary/5 transition-all group">
        <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
                <h3 class="text-xl font-bold text-text line-clamp-1">{{ $category->name }}</h3>
                <p class="text-text/60 text-[10px] uppercase font-black tracking-widest mt-1">ID: #{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.categories.edit', $category) }}" class="p-2 text-text/30 hover:text-primary transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-text/30 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
        </div>
        <p class="text-text/60 text-sm mb-6 line-clamp-2 h-10">{{ $category->description ?? 'No description provided.' }}</p>
        <div class="flex items-center justify-between py-4 border-t border-border mt-auto">
            <span class="text-xs font-bold text-text/40 uppercase">{{ $category->products_count ?? 0 }} Products</span>
            <a href="#" class="text-sm font-bold text-primary hover:underline transition-all">Browse →</a>
        </div>
    </div>
    @endforeach

    <!-- Add Category Placeholder -->
    <a href="{{ route('admin.categories.create') }}" class="p-8 border-2 border-dashed border-border rounded-3xl hover:border-primary/50 hover:bg-primary/5 transition-all group flex flex-col items-center justify-center text-center">
        <p class="font-bold text-text/40 group-hover:text-primary transition-all">+ Add New Collection</p>
    </a>
</div>
@endsection
