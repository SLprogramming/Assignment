<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Local Tailwind Script -->
    <script src="{{ asset('tailwind.js') }}"></script>

    <style type="text/tailwindcss">
        @theme {
            --color-primary: #6366f1;
            --color-primary-hover: #4f46e5;
            --color-primary-soft: #e0e7ff;
            --color-secondary: #ec4899; 
            --color-bg: #ffffff;
            --color-card: #fdfdff;
            --color-border: #e5e7eb;
            --color-text: #1e293b;
        }
        body {
            @apply font-['Inter'] bg-[#0f172a] text-slate-50 min-h-screen flex flex-col;
            background-image: radial-gradient(circle at 50% 50%, #1e1b4b 0%, #0f172a 100%);
        }
    </style>
</head>
<body class="antialiased">
    <nav class="sticky top-0 z-50 flex items-center justify-between px-8 py-6 backdrop-blur-md bg-slate-900/80 border-b border-white/10">
        <a href="/" class="text-2xl font-bold text-primary tracking-tighter">SLP</a>
        <div class="flex items-center gap-6">
            @auth
                <span class="text-sm font-medium text-slate-400">Hey, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-slate-400 border border-white/10 rounded-lg transition-all hover:bg-white/5 hover:text-white">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Login</a>
                <a href="{{ route('register') }}" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Register</a>
            @endauth
        </div>
    </nav>

    <main class="flex-1 flex items-center justify-center p-8">
        @yield('content')
    </main>

    @if(session('success'))
        <div id="success-toast" class="fixed bottom-8 right-8 px-6 py-4 bg-emerald-500 text-white rounded-xl shadow-2xl animate-in slide-in-from-right duration-300 z-[100]">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('success-toast').classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => document.getElementById('success-toast').remove(), 500);
            }, 3000);
        </script>
    @endif
</body>
</html>
