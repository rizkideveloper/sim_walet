<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Stock',
            'stocks' => Stock::all(),
        ];
        return view('dashboard.stock.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Stock',
            'products' => Product::all()
        ];
        return view('dashboard.stock.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'inputs.*.product_id' => 'required|distinct|unique:stocks'
            ],
            [
                'inputs.*.product_id.distinct' => 'enter product name a different',
                'inputs.*.product_id.required' => 'product name field is required',
                'inputs.*.product_id.unique' => 'product name has already been taken'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        } else {
            foreach ($request->inputs as $key => $value) {
                Stock::create([
                    'product_id' => $value['product_id'],
                    'jumlah_sarang' => 0,
                    'berat' => 0
                ]);
            }

            return response()->json(['status' => 1, 'message' => 'Data Stock has been added']);
        }

        // return response()->json(['status' => 1, 'data' => $request->all(), 'message' => 'Data Product has been added']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
