<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-2xl shadow">
                <h3 class="font-bold text-lg mb-6 underline">Edit Product: {{ $product->title }}</h3>
                
                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-bold">Product Name</label>
                        <input type="text" name="title" value="{{ $product->title }}" class="w-full rounded-lg border-gray-300">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold">Wholesale Price</label>
                            <input type="number" name="wholesale_price" value="{{ $product->wholesale_price }}" class="w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-bold">Selling Price</label>
                            <input type="number" name="selling_price" value="{{ $product->selling_price }}" class="w-full rounded-lg border-gray-300">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold uppercase">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>