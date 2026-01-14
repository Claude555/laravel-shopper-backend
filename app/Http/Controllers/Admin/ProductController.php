<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductRequest;
use App\Models\CustomerRequest;

class ProductController extends Controller
{
    public function dashboard()
    {
        // 1. Get the total count of products
        $totalProducts = Product::count();

        $products = Product::all();
    // Fetch real requests from the database to pass to the view
        $customerRequests = CustomerRequest::latest()->get();

        // 2. Calculate the total profit margin
        $projectedProfit = Product::all()->sum(function($product) {
            return $product->selling_price - $product->wholesale_price;
        });

        // 3. Fetch all custom requests from customers
        $customerRequests = ProductRequest::latest()->get();

        // 4. Pass EVERYTHING to the view
        return view('dashboard', [
            'totalProducts' => $totalProducts,
            'projectedProfit' => $projectedProfit,
            'customerRequests' => $customerRequests // The variable your Blade is looking for
        ]);
    }
    // Add this method to handle the API submission from Next.js
    public function storeRequest(Request $request) {
    $data = $request->validate([
        'customer_name' => 'required',
        'phone_number' => 'required',
        'item_description' => 'required',
        'location' => 'required',
    ]);

    CustomerRequest::create($data);
    return response()->json(['message' => 'Request received successfully!']);
}
    // READ: Display all products
   
    public function index(Request $request) 
{
    // Start a query instead of immediately getting all()
    $query = Product::query();

    // 1. Check for 'search' in the URL (e.g., ?search=keyword)
    if ($request->has('search') && $request->search != '') {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('title', 'LIKE', "%{$searchTerm}%")
              ->orWhere('description', 'LIKE', "%{$searchTerm}%")
              ->orWhere('category', 'LIKE', "%{$searchTerm}%");
        });
    }

    // 2. Check for 'category' in the URL (for your sidebar filters)
    if ($request->has('category') && $request->category != '') {
        $query->where('category', $request->category);
    }

    // Return the filtered results
    return response()->json($query->get());
}

    // CREATE: Show form
    public function create()
    {
        return view('admin.products.create');
    }

    // CREATE: Save to database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'wholesale_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'category' => 'required',
            'wholesaler_location' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Unique slug fix: Title + random string
        $validated['slug'] = Str::slug($request->title) . '-' . Str::lower(Str::random(5));

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    // UPDATE: Show edit form
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // UPDATE: Save changes
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'wholesale_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'category' => 'required',
            'wholesaler_location' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            Storage::disk('public')->delete($product->image);
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    // DELETE: Remove product
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted!');
    }
}