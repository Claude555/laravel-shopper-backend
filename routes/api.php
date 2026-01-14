<?php
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Models\ProductRequest;
use App\Http\Controllers\Admin\ProductController;

Route::post('/custom-request', function (Request $request) {
    $validated = $request->validate([
        'customer_name' => 'required',
        'phone_number' => 'required',
        'item_description' => 'required',
    ]);

    ProductRequest::create($validated);
    return response()->json(['message' => 'Request sent to our 
    Nairobi shoppers!']);
});

Route::post('/customer-requests', [ProductController::class, 'storeRequest']);

// This route will be accessible at: http://127.0.0.1:8000/api/products
Route::get('/products', function (Request $request) {
    $query = Product::query();

    // If a category is passed (e.g., /api/products?category=fashion)
    if ($request->has('category')) {
        $query->where('category', $request->category);
    }

    return $query->latest()->get();
});

Route::get('/products/{id}', function ($id) {
    // Log the ID to your laravel.log to see what is arriving
    Log::info("Fetching product with ID: " . $id);
    
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    return response()->json($product);
});
