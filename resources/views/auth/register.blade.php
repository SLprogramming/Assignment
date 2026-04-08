@extends('layouts.app')

@section('content')
<div class="w-full max-w-[450px] p-10 bg-white/5 border border-white/10 backdrop-blur-2xl rounded-3xl shadow-2xl">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold tracking-tight mb-2">Create account</h1>
        <p class="text-slate-400 text-sm">Join our premium community today</p>
    </div>

    <form action="{{ route('register') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-medium mb-2">Full Name</label>
            <input type="text" name="name" 
                class="w-full bg-white/5 border border-white/10 px-4 py-3 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all @error('name') border-red-500 @enderror" 
                value="{{ old('name') }}" placeholder="John Doe" required autofocus>
            @error('name')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Email Address</label>
            <input type="email" name="email" 
                class="w-full bg-white/5 border border-white/10 px-4 py-3 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all @error('email') border-red-500 @enderror" 
                value="{{ old('email') }}" placeholder="name@company.com" required>
            @error('email')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Password</label>
            <input type="password" name="password" 
                class="w-full bg-white/5 border border-white/10 px-4 py-3 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all @error('password') border-red-500 @enderror" 
                placeholder="••••••••" required>
            @error('password')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" 
                class="w-full bg-white/5 border border-white/10 px-4 py-3 rounded-xl text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" 
                placeholder="••••••••" required>
        </div>

        <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white font-semibold py-4 rounded-xl transition-all hover:-translate-y-0.5 shadow-lg shadow-primary/20 active:scale-[0.98]">
            Sign Up
        </button>
    </form>

    <div class="text-center mt-8 text-sm text-slate-400">
        Already have an account? <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Login here</a>
    </div>
</div>
@endsection
