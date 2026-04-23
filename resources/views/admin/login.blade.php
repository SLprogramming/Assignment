@php
    $simpleLayout = true;
@endphp

@extends('layouts.admin')

@section('admin-content')
<div class="w-full max-w-[450px] p-10 bg-card border border-border rounded-3xl shadow-xl shadow-primary/5">
    <div class="text-center mb-10">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-2xl mb-4">
            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </div>
        <h1 class="text-3xl font-bold tracking-tight mb-2 text-text">Admin Login</h1>
        <p class="text-text/60 text-sm">Welcome back, Boss! Manage your empire.</p>
    </div>

    <form action="/admin/login" method="POST" class="space-y-6">
        @csrf
        
        @if ($errors->any())
            <div class="p-4 bg-red-50 dark:bg-red-500/10 border-l-4 border-red-500 text-red-700 dark:text-red-400 text-sm rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <div>
            <label class="block text-sm font-medium mb-2" for="email">Admin Email</label>
            <input type="email" name="email" id="email"
                class="w-full bg-bg border border-border px-4 py-3 rounded-xl text-text placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" 
                placeholder="admin@shopnest.com" value="{{ old('email') }}" required autofocus>
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
                <span class="group-hover:text-text transition-colors">Stay logged in</span>
            </label>
            <a href="#" class="text-xs text-primary hover:underline">Forgot access?</a>
        </div>

        <button type="submit" class="w-full bg-primary hover:bg-primary-hover text-white font-semibold py-4 rounded-xl transition-all hover:-translate-y-0.5 shadow-lg shadow-primary/20">
            Secure Entry
        </button>
    </form>
</div>
@endsection
