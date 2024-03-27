<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::All();
        return view('products/index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product_types = ProductType::All();
        return view('products/create', compact('product_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // dd($request);
         $request->validate([
            'product_name' => 'required',
            'qty' => 'required',
            'selling_price' => 'required',
            'buying_price' => 'required',
            'product_typeid' => 'required',
        ]);
           
        $data = $request->all();
        // dd($data);
        $check = User::create([
            'product_name' => $data['product_name'],
            'qty' => $data['qty'],
            'selling_price' => $data['selling_price'],
            'buying_price' => $data['buying_price'],
            'product_typeid' =>$data['product_type']
        ]);
         
        return redirect()->route('products.index')->withSuccess('Great! You have Successfully Add a User');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
