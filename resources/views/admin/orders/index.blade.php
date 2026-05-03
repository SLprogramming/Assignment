@extends('layouts.admin')

@section('admin-content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-12">
        <div>
            <h1 class="text-4xl font-black text-text tracking-tight italic">Vault <span class="text-primary text-not-italic">Orders</span></h1>
            <p class="text-text/40 text-sm font-bold uppercase tracking-widest mt-2">Managing the flow of excellence</p>
        </div>

    </div>

    <div class="bg-card border border-border rounded-[3rem] overflow-hidden shadow-2xl shadow-primary/5">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-primary/5 border-b border-border">
                        <th class="px-8 py-6 text-[10px] font-black text-primary uppercase tracking-[0.2em]">Order ID</th>
                        <th class="px-8 py-6 text-[10px] font-black text-primary uppercase tracking-[0.2em]">Customer</th>
                        <th class="px-8 py-6 text-[10px] font-black text-primary uppercase tracking-[0.2em]">Total Price</th>
                        <th class="px-8 py-6 text-[10px] font-black text-primary uppercase tracking-[0.2em]">Status</th>
                        <th class="px-8 py-6 text-[10px] font-black text-primary uppercase tracking-[0.2em]">Placed At</th>
                        <th class="px-8 py-6 text-[10px] font-black text-primary uppercase tracking-[0.2em]">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($orders as $order)
                        <tr class="group hover:bg-primary/[0.02] transition-colors">
                            <td class="px-8 py-8">
                                <span class="font-black text-text">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td class="px-8 py-8">
                                <div class="flex flex-col">
                                    <span class="font-bold text-text">{{ $order->user->name }}</span>
                                    <span class="text-xs text-text/40 lowercase tracking-tight">{{ $order->user->email }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-8">
                                <span class="text-xl font-black text-primary">${{ number_format($order->total_price, 2) }}</span>
                            </td>
                            <td class="px-8 py-8">
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest 
                                    @if($order->status == 'completed') bg-green-500/10 text-green-500 border border-green-500/20
                                    @elseif($order->status == 'processing') bg-blue-500/10 text-blue-500 border border-blue-500/20
                                    @elseif($order->status == 'cancelled') bg-red-500/10 text-red-500 border border-red-500/20
                                    @else bg-secondary/10 text-secondary border border-secondary/20
                                    @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-8 py-8 text-sm font-medium text-text/40">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-8 py-8">
                                <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <div class="relative group">
                                        <select name="status" onchange="this.form.submit()" class="appearance-none bg-bg/50 backdrop-blur-md border border-border/80 hover:border-primary/50 text-[10px] font-black text-text uppercase tracking-widest rounded-xl px-4 py-2 pr-10 focus:ring-2 focus:ring-primary/20 focus:border-primary/80 outline-none transition-all cursor-pointer shadow-sm w-36">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }} class="bg-bg text-text uppercase tracking-widest font-black">Pending</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }} class="bg-bg text-text uppercase tracking-widest font-black">Processing</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }} class="bg-bg text-text uppercase tracking-widest font-black">Completed</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }} class="bg-bg text-text uppercase tracking-widest font-black">Cancelled</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-text/40 group-hover:text-primary transition-colors">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center justify-center space-y-4">
                                    <div class="w-20 h-20 rounded-full bg-primary/5 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-primary/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <span class="text-xl font-black text-text uppercase tracking-widest">No Orders Yet</span>
                                        <span class="text-sm text-text/40 font-medium">When customers start buying, they will appear here.</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    
    </div>
</div>
@endsection
