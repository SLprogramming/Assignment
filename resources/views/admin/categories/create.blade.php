@extends('layouts.admin')

@section('admin-content')
<div class="max-w-2xl mx-auto">
    <header class="mb-8">
        <a href="{{ route('admin.categories.index') }}" class="text-sm font-bold text-primary hover:underline flex items-center gap-2 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Categories
        </a>
        <h1 class="text-3xl font-bold tracking-tight text-text">Create New Category</h1>
        <p class="text-text/60">Define a new collection to organize your premium inventory.</p>
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

    <div class="bg-card border border-border rounded-3xl p-8 shadow-xl shadow-primary/5">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-text mb-2 uppercase tracking-wider">Category Name</label>
                <input type="text" id="name" name="name" placeholder="e.g. Winter Essentials" value="{{ old('name') }}"
                    class="w-full bg-bg border border-border px-5 py-4 rounded-2xl text-text placeholder-text/30 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all font-medium" required>
            </div>

            <div class="p-6 bg-bg/50 border border-border/50 rounded-2xl">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-[11px] font-black text-text/40 uppercase tracking-widest">URL Slug (SEO)</label>
                    <button type="button" id="generate-slug" class="flex items-center gap-1.5 text-[10px] text-primary font-bold uppercase hover:bg-primary/10 px-2 py-1 rounded-lg transition-all">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Generate from name
                    </button>
                </div>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-text/20 text-xs font-medium">flannel.com/category/</span>
                    <input type="text" id="slug" name="slug" placeholder="winter-essentials" value="{{ old('slug') }}"
                        class="w-full bg-transparent border-b border-border py-2 pl-36 pr-4 text-text/50 focus:outline-none focus:border-primary transition-all text-sm font-medium">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-text mb-2 uppercase tracking-wider">Description</label>
                <textarea id="description" name="description" rows="4" placeholder="Briefly describe what kind of items belong in this collection..." 
                    class="w-full bg-bg border border-border px-5 py-4 rounded-2xl text-text placeholder-text/30 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all font-medium">{{ old('description') }}</textarea>
            </div>

            <div class="pt-4 flex items-center gap-4">
                <button type="submit" class="flex-1 bg-primary text-white font-bold py-4 rounded-2xl hover:bg-primary-hover transition-all shadow-lg shadow-primary/20 hover:-translate-y-0.5">
                    Save Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="px-8 py-4 bg-bg border border-border text-text font-bold rounded-2xl hover:bg-card transition-all text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    const generateBtn = document.getElementById('generate-slug');

    generateBtn.addEventListener('click', () => {
        const nameValue = nameInput.value;
        if (nameValue) {
            const slugValue = nameValue
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '') 
                .replace(/[\s_-]+/g, '-')   
                .replace(/^-+|-+$/g, '');   
            
            slugInput.value = slugValue;
            
            generateBtn.classList.add('scale-95', 'opacity-50');
            setTimeout(() => generateBtn.classList.remove('scale-95', 'opacity-50'), 100);
        }
    });
</script>
@endpush
