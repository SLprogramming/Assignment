@extends('layouts.admin')

@section('admin-content')
<header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-bold tracking-tight text-text">Dashboard Overview</h1>
        <p class="text-text/60">Real-time performance analytics and management.</p>
    </div>
    <!-- <div class="flex items-center gap-3">
        <button class="px-5 py-2.5 bg-card border border-border text-text/70 font-semibold rounded-xl hover:bg-bg transition-all">
            Export Report
        </button>
        <button class="px-5 py-2.5 bg-primary text-white font-semibold rounded-xl shadow-lg shadow-primary/20 hover:bg-primary-hover transition-all">
            + Add New
        </button>
    </div> -->
</header>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="p-6 bg-card border border-border rounded-3xl shadow-sm">
        <div class="w-12 h-12 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <p class="text-sm font-medium text-text/50 mb-1">Total Sales</p>
        <h3 class="text-2xl font-bold text-text">${{ number_format($totalSales, 2) }}</h3>
        <span class="text-xs text-emerald-500 font-medium tracking-tight italic">Completed vault transactions</span>
    </div>
    <div class="p-6 bg-card border border-border rounded-3xl shadow-sm">
        <div class="w-12 h-12 bg-secondary/10 rounded-2xl flex items-center justify-center text-secondary mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        </div>
        <p class="text-sm font-medium text-text/50 mb-1">Total Orders</p>
        <h3 class="text-2xl font-bold text-text">{{ $orderCount }}</h3>
        <span class="text-xs text-primary font-medium tracking-tight italic">Units in processing pipeline</span>
    </div>
    <div class="p-6 bg-card border border-border rounded-3xl shadow-sm">
        <div class="w-12 h-12 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
        <p class="text-sm font-medium text-text/50 mb-1">Vault Membership</p>
        <h3 class="text-2xl font-bold text-text">{{ $customerCount }}</h3>
        <span class="text-xs text-emerald-500 font-medium tracking-tight italic">Active accounts enabled</span>
    </div>
</div>

<!-- Table / Recent Activity -->
<div class="p-8 bg-card border border-border rounded-3xl shadow-sm shadow-primary/5 mb-8">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-xl font-bold text-text">Recent Orders</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-sm text-primary font-bold uppercase tracking-widest hover:underline decoration-2 underline-offset-4">View All →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-text/30 text-[10px] font-black uppercase tracking-widest border-b border-border">
                    <th class="pb-4">Customer</th>
                    <th class="pb-4 text-center">Status</th>
                    <th class="pb-4 text-right">Net Value</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border/30">
                @foreach($recentOrders as $order)
                <tr>
                    <td class="py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary/5 flex items-center justify-center text-primary font-bold text-xs uppercase">
                                {{ substr($order->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-text">{{ $order->user->name }}</p>
                                <p class="text-[10px] text-text/30 font-bold uppercase tracking-tight italic">{{ $order->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-5 text-center">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest 
                            @if($order->status == 'completed') bg-emerald-500/10 text-emerald-600 
                            @elseif($order->status == 'pending') bg-secondary/10 text-secondary
                            @else bg-blue-500/10 text-blue-500 @endif border border-current/20">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="py-5 text-right font-black text-text">${{ number_format($order->total_price, 2) }}</td>
                </tr>
                @endforeach
                @if($recentOrders->isEmpty())
                <tr>
                    <td colspan="3" class="py-12 text-center text-text/20 font-bold italic">No orders detected in the vault yet.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
