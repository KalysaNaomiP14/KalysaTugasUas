<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();

        return response()->json([
            'message' => 'Data Produk Berhasil Ditampilkan',
            'data' => $produk,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth = $request->user();

        if ($auth->role == 'admin') {
            $request->validate([
                'nama_produk' => 'required|string',
                'harga' => 'required',
                'stok' => 'required|integer',
                'deskripsi' => 'required|string',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $gambar = $request->file('gambar')->store('produk', 'public');

            $produk = Produk::create([
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'deskripsi' => $request->deskripsi,
                'gambar' => $gambar,
            ]);

            return response()->json([
                'message' => 'Produk Berhasil Ditambahkan',
                'data' => $produk,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Anda Bukan Admin',
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::find($id);

        if ($produk) {
            return response()->json([
                'message' => 'Data Produk Berhasil Ditampilkan',
                'data' => $produk,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data Produk Tidak Ditemukan',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $auth = $request->user();

        if ($auth->role == 'admin') {
            $produk = Produk::find($id);

            if ($produk) {

                if ($request->file('gambar')) {
                    $gambar = $request->file('gambar')->store('produk', 'public');
                } else {
                    $gambar = $produk->gambar;
                }

                $produk->update([
                    'nama_produk' => $request->nama_produk ? $request->nama_produk : $produk->nama_produk,
                    'harga' => $request->harga ? $request->harga : $produk->harga,
                    'stok' => $request->stok ? $request->stok : $produk->stok,
                    'deskripsi' => $request->deskripsi ? $request->deskripsi : $produk->deskripsi,
                    'gambar' => $gambar,
                ]);

                return response()->json([
                    'message' => 'Produk Berhasil Diubah',
                    'data' => $produk,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data Produk Tidak Ditemukan',
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'Anda Bukan Admin',
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);

        if ($produk) {
            $produk->delete();

            return response()->json([
                'message' => 'Produk Berhasil Dihapus',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data Produk Tidak Ditemukan',
            ], 404);
        }
    }
}
