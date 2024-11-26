<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangMasuk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'detail_barangmasuk';
    protected $with = ['barang_masuk','product'];

    public function barang_masuk()
    {
        //relasi dari tabel detail_barangmasuk ke table barang_masuk
        //yang dititipkan (belongsTo)
        return $this->belongsTo(BarangMasuk::class);
    }

    public function product()
    {
        //relasi dari tabel detail_barangmasuk ke table product
        //yang dititipkan (belongsTo)
        return $this->belongsTo(Product::class);
    }
}
