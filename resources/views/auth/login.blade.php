@extends('layouts.app')

@section('content')
<div class="w-full max-w-[450px] p-10 bg-card border border-border rounded-3xl shadow-xl shadow-primary/5">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold tracking-tight mb-2 text-text">Welcome back</h1>
        <p class="text-text/60 text-sm">Please enter your details to sign in</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-lg">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-medium mb-2" for="email">Email Address</label>
            <input type="email" name="email" id="email"
                class="w-full bg-bg border border-border px-4 py-3 rounded-xl text-text placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all @error('email') border-red-500 @enderror" 
                value="{{ old('email') }}" placeholder="name@company.com" required autofocus>
            @error('email')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2" for="password">Password</label>
            <input type="password" name="password" id="password"
                class="w-full bg-bg border border-border px-4 py-3 rounded-xl text-text placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" 
                placeholder="••••••••" required>
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-text/60 cursor-pointer group">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-border bg-bg accent-primary">
                <span class="group-hover:text-text transition-colors">Remember me</span>
            </label>
            <a href="#" class="text-xs text-primary hover:text-primary-hover transition-colors">Forgot password?</a>
        </div>

        <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white font-semibold py-4 rounded-xl transition-all hover:-translate-y-0.5 shadow-lg shadow-primary/20 active:scale-[0.98]">
            Sign In
        </button>
    </form>

    <div class="text-center mt-8 text-sm text-text/60">
        Don't have an account? <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">Create one</a>
    </div>
</div>
@endsection
