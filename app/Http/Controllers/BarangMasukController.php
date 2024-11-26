<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Barang Masuk',
            'barang_masuk' => BarangMasuk::all()
        ];
        return view('dashboard.barang_masuk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Add Barang Masuk',
            'products' => Product::all()
        ];
        return view('dashboard.barang_masuk.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tanggal_masuk' => 'required',
                'inputs.*.product_id' => 'required|distinct',
                'inputs.*.jumlah_sarang' => 'required|numeric',
                'inputs.*.berat' => 'required|numeric',
            ],
            [
                'tanggal_masuk.required' => 'date field is required',
                'inputs.*.product_id.distinct' => 'enter product name a different',
                'inputs.*.product_id.required' => 'product name field is required',
                'inputs.*.jumlah_sarang.numeric' => 'jumlah sarang field must be number',
                'inputs.*.jumlah_sarang.required' => 'jumlah sarang field is required',
                'inputs.*.berat.numeric' => 'berat field must be number',
                'inputs.*.berat.required' => 'berat field is required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        } else {
            $total_sarang = 0;
            $total_berat = 0;
            foreach ($request->inputs as $key => $value) {
                $stok = Stock::find($value['product_id']);
                Stock::where('id', $value['product_id'])->update([
                    'jumlah_sarang' => $value['jumlah_sarang'] + $stok['jumlah_sarang'],
                    'berat' => $value['berat'] + $stok['berat']
                ]);

                $total_sarang += $value['jumlah_sarang'];
                $total_berat += $value['berat'];
            }

            $barang_masuk = BarangMasuk::create([
                'tanggal_masuk' => $request->tanggal_masuk,
                'total_sarang' => $total_sarang,
                'total_berat' => $total_berat,
            ]);

            foreach ($request->inputs as $key => $value) {
                DB::table('detail_barangmasuk')->insert([
                    'barang_masuk_id' => $barang_masuk->id,
                    'product_id' => $value['product_id'],
                    'jumlah_sarang' => $value['jumlah_sarang'],
                    'berat' => $value['berat'],

                ]);
            }

            return response()->json(['status' => 1, 'message' => 'Data Barang Masuk has been added']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangmasuk)
    {
        $barang_masuk = BarangMasuk::find($barangmasuk->id);
        // $produk = Product::whereNotIn('')->get();

        $data = [
            'title' => 'Detail Barang Masuk',
            'barangmasuk' => $barang_masuk,
            'detail_barangmasuk' => DetailBarangMasuk::where('barang_masuk_id', $barangmasuk->id)->get()
        ];
        return view('dashboard.barang_masuk.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($detailId)
    {
        $detail_barangmasuk = DetailBarangMasuk::find($detailId);
        $produkId = DetailBarangMasuk::where([
             ['barang_masuk_id','=',$detail_barangmasuk->barang_masuk_id],
            ['product_id','<>',$detail_barangmasuk->product_id],
            ])->get();

        $id = [];
        foreach ($produkId as $key => $value) {
            array_push($id, $value['product_id']);
        }

        $produk = Product::whereNotIn('id', $id)->get();
        $data = [
            'detail_barangmasuk' => $detail_barangmasuk,
            'produk' => $produk,
        ];

        return response()->json([
            'status' => 1,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangmasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barangmasuk)
    {
        //
    }
}
