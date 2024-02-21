<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'id_siswa',
        'id_barang',
        'tgl_pinjam',
        'tgl_kembali'
    ];

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'id_siswa');
    }

    public function barang()
    {
        return $this->belongsTo(barang::class, 'id_barang');
    }

}
