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
            @apply font-['Inter'] bg-bg text-text min-h-screen flex flex-col transition-colors duration-300;
        }
    </style>

    <script>
        // Prevent layout shift/flash of light theme
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="antialiased">
    <nav class="sticky top-0 z-50 flex items-center justify-between px-8 py-6 backdrop-blur-md bg-card/80 border-b border-border shadow-sm">
        <a href="/" class="text-2xl font-bold text-primary tracking-tighter">Flannel</a>
        <div class="flex items-center gap-6">
            <!-- Theme Toggle -->
            <button id="theme-toggle" class="p-2 rounded-xl bg-bg border border-border text-text/70 hover:text-primary transition-all duration-300 hover:shadow-lg hover:shadow-primary/10">
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
            </button>
            @auth
                <span class="text-sm font-medium text-text mt-0.5">Hey, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-text border border-border rounded-lg transition-all hover:bg-bg">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm font-medium text-text/70 hover:text-primary transition-colors">Login</a>
                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-primary-hover transition-all shadow-lg shadow-primary/20">Register</a>
            @endauth
        </div>
    </nav>

    <main class="flex-1 flex items-center justify-center p-8">
        @yield('content')
    </main>

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

        // Set initial icon state
        updateIcons();

        themeToggleBtn.addEventListener('click', function() {
            // Toggle class on html element
            document.documentElement.classList.toggle('dark');
            
            // Save preference
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }

            // Sync icons
            updateIcons();
        });
    </script>
</body>
</html>
