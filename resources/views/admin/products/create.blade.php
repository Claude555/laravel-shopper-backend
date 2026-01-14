<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight italic">
            {{ __('Add New Wholesaler Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8">
                
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase">Product Name</label>
                            <input type="text" name="title" placeholder="e.g. Generic 7-Speed Kitchen Blender" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase">Wholesale Cost (Your Buy Price)</label>
                            <div class="relative mt-1">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">KSh</span>
                                <input type="number" name="wholesale_price" class="block w-full pl-12 border-gray-300 rounded-xl shadow-sm focus:border-gray-500 focus:ring-gray-500" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-orange-600 uppercase">Selling Price (Customer Price)</label>
                            <div class="relative mt-1">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-orange-500 font-bold">KSh</span>
                                <input type="number" name="selling_price" class="block w-full pl-12 border-orange-500 rounded-xl shadow-sm focus:border-orange-500 focus:ring-orange-500 font-bold" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase">Market Category</label>
                            <select name="category" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:border-orange-500">
                                <option value="electronics">Electronics</option>
                                <option value="kitchen">Kitchenware</option>
                                <option value="fashion">Fashion</option>
                                <option value="accessories">Accessories</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase">Sourcing Hub</label>
                            <select name="wholesaler_location" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm">
                                <option value="Kamukunji">Kamukunji</option>
                                <option value="Eastleigh">Eastleigh</option>
                                <option value="River Road">River Road</option>
                                <option value="Luthuli Avenue">Luthuli Avenue</option>
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase">Product Photo</label>
                            <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-orange-500 font-black py-4 rounded-xl shadow-lg hover:bg-orange-600 transition uppercase tracking-widest">
                            Add to Nairobi Inventory
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>