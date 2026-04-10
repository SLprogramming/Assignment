@extends('layouts.admin')

@section('admin-content')
<header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-text">Dashboard Overview</h1>
        <p class="text-text/60">Real-time performance analytics and management.</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="px-5 py-2.5 bg-card border border-border text-text/70 font-semibold rounded-xl hover:bg-bg transition-all">
            Export Report
        </button>
        <button class="px-5 py-2.5 bg-primary text-white font-semibold rounded-xl shadow-lg shadow-primary/20 hover:bg-primary-hover transition-all">
            + Add New
        </button>
    </div>
</header>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="p-6 bg-card border border-border rounded-3xl shadow-sm">
        <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <p class="text-sm font-medium text-text/50 mb-1">Total Sales</p>
        <h3 class="text-2xl font-bold text-text">$128,430</h3>
        <span class="text-xs text-emerald-500 font-medium">+12.5% vs last week</span>
    </div>
    <div class="p-6 bg-card border border-border rounded-3xl shadow-sm">
        <div class="w-12 h-12 bg-secondary/10 rounded-2xl flex items-center justify-center text-secondary mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        </div>
        <p class="text-sm font-medium text-text/50 mb-1">Orders</p>
        <h3 class="text-2xl font-bold text-text">1,205</h3>
        <span class="text-xs text-primary font-medium">+24 new today</span>
    </div>
    <div class="p-6 bg-card border border-border rounded-3xl shadow-sm">
        <div class="w-12 h-12 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <p class="text-sm font-medium text-text/50 mb-1">Customers</p>
        <h3 class="text-2xl font-bold text-text">8,492</h3>
        <span class="text-xs text-emerald-500 font-medium">+156 organic</span>
    </div>
    <div class="p-6 bg-card border border-border rounded-3xl shadow-sm">
        <div class="w-12 h-12 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-500 mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
        </div>
        <p class="text-sm font-medium text-text/50 mb-1">Conversion</p>
        <h3 class="text-2xl font-bold text-text">3.24%</h3>
        <span class="text-xs text-red-500 font-medium">-0.5% fluctuation</span>
    </div>
</div>

<!-- Table / Recent Activity -->
<div class="p-8 bg-card border border-border rounded-3xl shadow-sm shadow-primary/5 mb-8">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-xl font-bold text-text">Recent Orders</h2>
        <a href="#" class="text-sm text-primary font-medium hover:underline">View all</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-text/50 text-sm border-b border-border">
                    <th class="pb-4 font-medium uppercase tracking-wider">Customer</th>
                    <th class="pb-4 font-medium uppercase tracking-wider text-center">Items</th>
                    <th class="pb-4 font-medium uppercase tracking-wider text-center">Status</th>
                    <th class="pb-4 font-medium uppercase tracking-wider text-right">Net Profit</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border/30">
                <tr>
                    <td class="py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-700"></div>
                            <div>
                                <p class="text-sm font-bold text-text">Cody Fisherman</p>
                                <p class="text-xs text-text/50">cody@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-5 text-center text-text/70">3 Products</td>
                    <td class="py-5 text-center">
                        <span class="px-2.5 py-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-[11px] font-bold rounded-lg uppercase">Delivered</span>
                    </td>
                    <td class="py-5 text-right font-bold text-text">$845.00</td>
                </tr>
                <tr>
                    <td class="py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-700"></div>
                            <div>
                                <p class="text-sm font-bold text-text">Esther Howard</p>
                                <p class="text-xs text-text/50">esther@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-5 text-center text-text/70">1 Product</td>
                    <td class="py-5 text-center">
                        <span class="px-2.5 py-1 bg-amber-500/10 text-amber-600 dark:text-amber-400 text-[11px] font-bold rounded-lg uppercase">Pending</span>
                    </td>
                    <td class="py-5 text-right font-bold text-text">$1,200.50</td>
                </tr>
                <tr>
                    <td class="py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-700"></div>
                            <div>
                                <p class="text-sm font-bold text-text">Dianne Russell</p>
                                <p class="text-xs text-text/50">dianne@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-5 text-center text-text/70">2 Products</td>
                    <td class="py-5 text-center">
                        <span class="px-2.5 py-1 bg-blue-500/10 text-blue-600 dark:text-blue-400 text-[11px] font-bold rounded-lg uppercase">Shipped</span>
                    </td>
                    <td class="py-5 text-right font-bold text-text">$159.99</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
