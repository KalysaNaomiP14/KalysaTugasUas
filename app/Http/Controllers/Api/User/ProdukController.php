<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();

        return response()->json([
            'message' => 'Data Produk Berhasil Ditampilkan',
            'data' => $produk,
        ], 200);
    }

    public function show($id)
    {
        $produk = Produk::find($id);

        return response()->json([
            'message' => 'Data Produk Berhasil Ditampilkan',
            'data' => $produk,
        ], 200);
    }
}
