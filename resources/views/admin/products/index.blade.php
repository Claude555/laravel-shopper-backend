<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-6">
                <h2 class="text-2xl font-bold uppercase italic">Nairobi Inventory</h2>
                <a href="{{ route('admin.products.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg font-bold">Add Item</a>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3">Product</th>
                            <th class="px-6 py-3">Hub</th>
                            <th class="px-6 py-3">Wholesale</th>
                            <th class="px-6 py-3">Retail</th>
                            <th class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4 flex items-center gap-3">
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-10 h-10 object-cover rounded">
                                <span class="font-bold">{{ $product->title }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-blue-600 font-bold">{{ $product->wholesaler_location }}</td>
                            <td class="px-6 py-4 text-sm">KSh {{ number_format($product->wholesale_price) }}</td>
                            <td class="px-6 py-4 text-sm font-black">KSh {{ number_format($product->selling_price) }}</td>
                            <td class="px-6 py-4 text-right flex justify-end gap-3">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-gray-500 hover:text-orange-500">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600" onclick="return confirm('Delete this item?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>