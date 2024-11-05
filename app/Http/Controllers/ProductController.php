<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {

        $this->middleware(['permission:View Products'], ['only' => ['index']]);
        $this->middleware(['permission:Create Products'], ['only' => ['create']]);
        $this->middleware(['permission:Edit Products'], ['only' => ['edit']]);
        $this->middleware(['permission:Delete Products'], ['only' => ['destroy']]);


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
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
             'quantity'=> 'required',
             'price'=> 'required',
     ]);
     if ($validator->passes()){

        $product = new Product();
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->save();


    return redirect()->route('products.index')->with('success', 'Prod created successfully.');

    }
    else{
    return redirect()->route('products.create')->withInput()->withErrors($validator);
    }
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
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
             'quantity'=> 'required',
             'price'=> 'required',
     ]);
     if ($validator->passes()){


        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->save();


    return redirect()->route('products.index')->with('success', 'Product created successfully.');

    }
    else{
    return redirect()->route('products.edit')->withInput()->withErrors($validator);
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
