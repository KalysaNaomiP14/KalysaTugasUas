<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class OrderProdutController extends Controller
{
    public function store(Request $request)
    {
        $produk = Produk::find($request->produk_id);

        $request->validate([
            'produk_id' => 'required|integer',
            'jumlah_pembelian' => 'required|integer',
        ]);

        $transaksi = Transaksi::create([
            'user_id' => $request->user()->id,
            'produk_id' => $request->produk_id,
            'nama' => $request->user()->name,
            'email' => $request->user()->email,
            'no_hp' => $request->user()->no_hp,
            'alamat' => $request->user()->alamat,
            'jumlah_pembelian' => $request->jumlah_pembelian,
            'total_harga' => $produk->harga * $request->jumlah_pembelian,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Data Transaksi Berhasil Ditambahkan',
            'data' => $transaksi,
        ], 201);
    }
}
