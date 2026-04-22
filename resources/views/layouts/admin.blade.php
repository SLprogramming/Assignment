<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - {{ config('app.name', 'Flannel') }}</title>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Local Tailwind Script -->
    <script src="{{ asset('tailwind.js') }}"></script>

    <style type="text/tailwindcss">
    @theme {
    --color-primary: #10b981;       /* Emerald */
    --color-primary-hover: #059669;
    --color-primary-soft: #ecfdf5;
    --color-secondary: #f59e0b;    /* Amber accent */
    --color-bg: #fcfcfb;
    --color-card: #ffffff;
    --color-border: #f1f1ef;
    --color-text: #27272a;         /* Zinc-800 text */
    }
    .dark {
    --color-primary: #06b6d4;       /* Vivid Cyan */
    --color-primary-hover: #0891b2;
    --color-primary-soft: rgba(6, 182, 212, 0.1);
    --color-secondary: #8b5cf6;    /* Violet accent */
    --color-bg: #0f172a;           /* Deep Slate blue-black */
    --color-card: #1e293b;         /* Lighter slate for depth */
    --color-border: #334155;       /* Subtle border contrast */
    --color-text: #f1f5f9;         /* Off-white for readability */
    }
    body {
        @apply font-['Inter'] bg-bg text-text h-screen flex flex-col transition-colors duration-300 overflow-hidden;
    }
    </style>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="antialiased">
    <!-- Top Bar -->
    <nav class="sticky top-0 z-50 flex items-center justify-between px-8 py-4 backdrop-blur-md bg-card/80 border-b border-border shadow-sm">
        <div class="flex items-center gap-4">
            <a href="/" class="text-xl font-bold text-primary tracking-tighter">Flannel Admin</a>
        </div>
        
        <div class="flex items-center gap-6">
            <button id="theme-toggle" class="p-2 rounded-xl bg-bg border border-border text-text/70 hover:text-primary transition-all duration-300">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
            </button>
            @if(!isset($simpleLayout))
            <div class="h-8 w-px bg-border"></div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-text">{{ auth()->user()?->name ?? 'Admin User' }}</p>
                    <p class="text-xs text-text/50">Super Administrator</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold transition-transform hover:scale-110">
                    {{ substr(auth()->user()?->name ?? 'A', 0, 1) }}
                </div>
            </div>
            @endif
        </div>
    </nav>

    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        @if(!isset($simpleLayout))
        <aside class="flex-shrink-0 w-64 flex flex-col bg-card border-r border-border py-6 px-4">
            <nav class="flex-1 space-y-1">
                <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/dashboard') ? 'bg-primary/10 text-primary font-semibold' : 'text-text/70 hover:bg-bg transition-colors' }} rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="/admin/products" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/products*') ? 'bg-primary/10 text-primary font-semibold' : 'text-text/70 hover:bg-bg transition-colors' }} rounded-xl group no-underline">
                    <svg class="w-5 h-5 group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Products
                </a>
                <a href="/admin/categories" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/categories*') ? 'bg-primary/10 text-primary font-semibold' : 'text-text/70 hover:bg-bg transition-colors' }} rounded-xl group no-underline">
                    <svg class="w-5 h-5 group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"></path></svg>
                    Categories
                </a>
                <a href="/admin/orders" class="flex items-center gap-3 px-4 py-3 {{ request()->is('admin/orders*') ? 'bg-primary/10 text-primary font-semibold' : 'text-text/70 hover:bg-bg transition-colors' }} rounded-xl group no-underline">
                    <svg class="w-5 h-5 group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Orders
                </a>
                <div class="pt-4 pb-2 px-4">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-text/30">Management</p>
                </div>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-text/70 hover:bg-bg rounded-xl transition-colors group">
                    <svg class="w-5 h-5 group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Team Members
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-text/70 hover:bg-bg rounded-xl transition-colors group">
                    <svg class="w-5 h-5 group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </a>
            </nav>

            <div class="mt-auto px-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-red-500 bg-red-50 dark:bg-red-500/10 rounded-xl font-semibold hover:bg-red-100 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </aside>
        @endif

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-8 {{ isset($simpleLayout) ? 'flex items-center justify-center' : '' }}">
            <div class="max-w-7xl mx-auto">
                @yield('admin-content')
            </div>
        </main>
    </div>

    @if(session('success'))
        <div id="success-toast" class="fixed bottom-8 right-8 px-6 py-4 bg-primary text-white rounded-xl shadow-2xl animate-in slide-in-from-right duration-300 z-[100]">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('success-toast').classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => document.getElementById('success-toast').remove(), 500);
            }, 3000);
        </script>
    @endif

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        function updateIcons() {
            if (document.documentElement.classList.contains('dark')) {
                lightIcon.classList.remove('hidden');
                darkIcon.classList.add('hidden');
            } else {
                lightIcon.classList.add('hidden');
                darkIcon.classList.remove('hidden');
            }
        }

        updateIcons();

        themeToggleBtn.addEventListener('click', function() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            updateIcons();
        });
    </script>
    @stack('scripts')
</body>
</html>
