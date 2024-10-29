<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Product',
            'products' => Product::all()
        ];
        return view('dashboard.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Product'
        ];
        return view('dashboard.product.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'products.*' => 'required|distinct'
            ],
            [
                'products.*.required' => 'product name field is required',
                'products.*.distinct' => 'enter product name a different for each product name'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        } else {
            $products=[];
            foreach ($request->products as $key => $value) {
                $create= Product::create(['product_name' => $value]);
                array_push($products, $create);
            }

            return response()->json(['status' => 1,'data'=>$products, 'message' => 'Data Product has been added']);
        }
    }

    // public function store(Request $request)
    // {
    //     $rules = $request->validate([
    //         'products.*.name' => 'required'
    //     ],[
    //         'required' => 'Product name field is required'
    //     ]);

    //     dd($rules);

    // }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $data =[
            'title' => 'Edit Product',
            'product' => Product::find($product->id)
        ];

        return view('dashboard.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'product_name' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        } else {
            $product = Product::where('id', $product->id)->update(['product_name' => $request->product_name]);

            return response()->json(['status' => 1, 'data' => $product, 'message' => 'Data Product has been edited']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);

        return redirect('/product')->with('success','Data Product has been deleted');
    }
}
