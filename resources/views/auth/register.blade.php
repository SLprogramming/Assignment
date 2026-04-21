@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center py-12 min-h-[calc(100vh-160px)]">
    <div class="w-full max-w-[450px] p-10 bg-card border border-border rounded-3xl shadow-xl shadow-primary/5">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold tracking-tight mb-2 text-text">Create account</h1>
            <p class="text-text/60 text-sm">Join our premium community today</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-medium mb-2">Full Name</label>
                <input type="text" name="name" 
                    class="w-full bg-bg border border-border px-4 py-3 rounded-xl text-text placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all @error('name') border-red-500 @enderror" 
                    value="{{ old('name') }}" placeholder="John Doe" required autofocus>
                @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Email Address</label>
                <input type="email" name="email" 
                    class="w-full bg-bg border border-border px-4 py-3 rounded-xl text-text placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all @error('email') border-red-500 @enderror" 
                    value="{{ old('email') }}" placeholder="name@company.com" required>
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" 
                    class="w-full bg-bg border border-border px-4 py-3 rounded-xl text-text placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all @error('password') border-red-500 @enderror" 
                    placeholder="••••••••" required>
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" 
                    class="w-full bg-bg border border-border px-4 py-3 rounded-xl text-text placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" 
                    placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white font-semibold py-4 rounded-xl transition-all hover:-translate-y-0.5 shadow-lg shadow-primary/20 active:scale-[0.98]">
                Sign Up
            </button>
        </form>

        <div class="text-center mt-8 text-sm text-text/60">
            Already have an account? <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Login here</a>
        </div>
    </div>
</div>
@endsection
