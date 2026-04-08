@extends('layouts.app')

@section('content')
<div class="text-center max-w-4xl px-4 py-12">
    <!-- Hero Section -->
    <h1 class="text-6xl md:text-8xl font-black tracking-tighter mb-8 bg-gradient-to-r from-white via-white to-primary bg-clip-text text-transparent">
        Welcome to SLP
    </h1>
    <p class="text-lg md:text-xl text-slate-400 font-medium leading-relaxed mb-12 max-w-2xl mx-auto">
        A premium full-stack application built with Laravel and Tailwind CSS. Experience the power of modern web architecture with stunning aesthetics.
    </p>

    @auth
        <div class="mb-16 p-8 bg-white/5 border border-white/10 backdrop-blur-xl rounded-3xl inline-block shadow-2xl">
            <p class="text-2xl font-semibold">
                You're logged in as <span class="text-primary underline decoration-primary/30 underline-offset-8">{{ auth()->user()->name }}</span>
            </p>
        </div>
    @else
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
            <a href="{{ route('register') }}" 
                class="px-10 py-4 bg-white text-slate-950 font-bold rounded-full transition-all hover:scale-105 hover:shadow-[0_0_30px_rgba(255,255,255,0.3)] duration-300">
                Get Started
            </a>
            <a href="{{ route('login') }}" 
                class="px-10 py-4 bg-white/5 border border-white/10 text-white font-bold rounded-full transition-all hover:bg-white/10 duration-300">
                Sign In
            </a>
        </div>
    @endauth

    <!-- Feature Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-8 bg-white/5 border border-white/10 backdrop-blur-lg rounded-2xl text-left transition-all hover:-translate-y-2 hover:bg-white/10 group">
            <h3 class="text-primary font-bold text-xl mb-3 group-hover:text-primary-hover transition-colors">Tailwind v4</h3>
            <p class="text-slate-400 text-sm leading-relaxed">
                Utilizing the latest Tailwind technologies for extremely fast, responsive, and beautiful interfaces.
            </p>
        </div>
        <div class="p-8 bg-white/5 border border-white/10 backdrop-blur-lg rounded-2xl text-left transition-all hover:-translate-y-2 hover:bg-white/10 group">
            <h3 class="text-primary font-bold text-xl mb-3 group-hover:text-primary-hover transition-colors">Rich UI</h3>
            <p class="text-slate-400 text-sm leading-relaxed">
                Pure utility classes providing maximum flexibility and high-end aesthetics without custom CSS files.
            </p>
        </div>
        <div class="p-8 bg-white/5 border border-white/10 backdrop-blur-lg rounded-2xl text-left transition-all hover:-translate-y-2 hover:bg-white/10 group">
            <h3 class="text-primary font-bold text-xl mb-3 group-hover:text-primary-hover transition-colors">Laravel 10</h3>
            <p class="text-slate-400 text-sm leading-relaxed">
                A robust backend architecture ensuring secure authentication and lightning-fast server-side rendering.
            </p>
        </div>
    </div>
</div>
@endsection
