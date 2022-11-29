<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produk_id',
        'nama',
        'email',
        'no_hp',
        'alamat',
        'jumlah_pembelian',
        'total_harga',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
