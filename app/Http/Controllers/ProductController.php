<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {

        $this->middleware(['permission:View Product'], ['only' => ['index']]);
        $this->middleware(['permission:Create Product'], ['only' => ['create']]);
        $this->middleware(['permission:Edit Product'], ['only' => ['edit']]);
        $this->middleware(['permission:Delete Product'], ['only' => ['destroy']]);
        $this->middleware(['permission:Status Product'],['only' => ['updateStatus']]);


    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.list',[
       'products'=>$products
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        {
            return view('products.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }
    
        $product = new Product();
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
    
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('products', 'public'); // Save to 'storage/app/public/products'
            $product->photo = $imagePath; // Save relative path
        }
    
        $product->save();
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
            return view('products.edit',[
            'product'=>$product
]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'quantity' => 'required',
        'price' => 'required',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
    }

    $product->name = $request->name;
    $product->quantity = $request->quantity;
    $product->price = $request->price;

    if ($request->hasFile('photo')) {
        // Delete the old photo if it exists
        if ($product->photo && Storage::disk('public')->exists($product->photo)) {
            Storage::disk('public')->delete($product->photo);
        }

        // Save the new photo
        $imagePath = $request->file('photo')->store('products', 'public');
        $product->photo = $imagePath;
    }

    $product->save();

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}
    
public function destroy(string $id)
{
    $product = Product::findOrFail($id);

    if ($product->photo) {
        $filePath = $product->photo;

        // Check if file exists
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath); // Delete the file
        } else {
            Log::error("File not found: " . $filePath);
        }
    }

    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
}


    public function updateStatus(Request $request, $id)
    {
        $product = Product::findOrFail($id);
    
        $status = $request->query('status');
    
        // Check if the status is valid and update it
        if ($status === 'approved' || $status === 'rejected') {
            $product->update(['status' => $status]);
    
            return redirect()->route('products.index')
                ->with('success', "Product status updated to {$status}.");
        }
    
        return back()->with('error', 'Invalid status.');
    }
}