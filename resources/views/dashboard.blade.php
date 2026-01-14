<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 leading-tight uppercase italic">
                {{ __('Service Overview') }}
            </h2>
            <div class="flex gap-4">
                <a href="{{ route('admin.products.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-black transition">
                    VIEW INVENTORY
                </a>
                <a href="{{ route('admin.products.create') }}" class="bg-[#f68b1e] text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-orange-600 transition">
                    + ADD PRODUCT
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Total Sourced Items</p>
                    <p class="text-3xl font-black mt-2 text-gray-800">{{ \App\Models\Product::count() }}</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Active Requests</p>
                    <p class="text-3xl font-black mt-2 text-green-600">0</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Projected Profit</p>
                    <p class="text-3xl font-black mt-2 text-[#f68b1e]">0</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-10 text-center">
                <h3 class="text-2xl font-black italic text-gray-800 uppercase mb-4">Inventory Management</h3>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">Manage your products sourced from Kamukunji, Eastleigh, and the CBD. Track wholesale vs retail margins.</p>
                
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <a href="{{ route('admin.products.index') }}" class="bg-white border-2 border-gray-800 text-gray-800 px-8 py-4 rounded-xl font-bold hover:bg-gray-50 transition uppercase tracking-tighter">
                        Browse All Products
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="bg-[#f68b1e] text-white px-8 py-4 rounded-xl font-bold hover:shadow-lg transition uppercase tracking-tighter">
                        Add New Wholesale Item
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-8">
    <div class="p-6 text-gray-900">
        <h3 class="font-bold text-lg mb-4 uppercase italic">Pending Customer Requests</h3>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 uppercase text-xs font-black">
                        <th class="p-3">Customer</th>
                        <th class="p-3">Contact</th>
                        <th class="p-3">Item Description</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($customerRequests as $request)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 font-bold">{{ $request->customer_name }}</td>
                        <td class="p-3 text-blue-600">
                            <a href="https://wa.me/{{ $request->phone_number }}" target="_blank">
                                {{ $request->phone_number }}
                            </a>
                        </td>
                        <td class="p-3 text-sm text-gray-600">{{ $request->item_description }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded-full text-xs font-bold 
                                {{ $request->status == 'pending' ? 'bg-orange-100 text-orange-700' : 'bg-green-100 text-green-700' }}">
                                {{ strtoupper($request->status) }}
                            </span>
                        </td>
                        <td class="p-3 text-right">
                            <button class="text-xs bg-gray-800 text-white px-3 py-1 rounded hover:bg-black">
                                Mark Sourced
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-gray-400 italic">No custom requests yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>