<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeminjamanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $peminjamans= Peminjaman::latest()->paginate(5);

        //render view with posts
        return view('peminjaman.index', compact('peminjamans'));
    }

       /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $siswa = Siswa::all();
        $barang = Barang::all();
        return view('peminjaman.create', compact('siswa','barang'));
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request, Peminjaman $peminjaman)
    {
        //validate form
        $this->validate($request, [

            'id_siswa'   => 'required',
            'id_barang'   => 'required',
            'tgl_pinjam'   => 'required',
            'tgl_kembali'   => 'required',
        ]);


        //create siswa
        Peminjaman::create([
            'id_siswa'   => $request->input('id_siswa'),
            'id_barang'   => $request->input('id_barang'),
            'tgl_pinjam'   => $request->input('tgl_pinjam'),
            'tgl_kembali'   => $request->input('tgl_kembali'),


        ]);

        //redirect to index
        return redirect()->route('peminjaman.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * edit
     *
     * @param  mixed $peminjaman
     * @return void
     */
    public function edit(Peminjaman $peminjaman)
    {

        $siswa = Siswa::all();
        $barang = Barang::all();
        return view('peminjaman.edit', compact('peminjaman','siswa','barang'));
    }

     /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //validate form
        $this->validate($request, [

            'id_siswa'   => 'required',
            'id_barang'   => 'required',
            'tgl_pinjam'   => 'required',
            'tgl_kembali'   => 'required',

        ]);
        $peminjaman->update([
            'id_siswa'   => $request->input('id_siswa'),
            'id_barang'   => $request->input('id_barang'),
            'tgl_pinjam'   => $request->input('tgl_pinjam'),
            'tgl_kembali'   => $request->input('tgl_kembali'),
        ]);

        //redirect to index
        return redirect()->route('peminjaman.index')->with(['success' => 'Berhasil melakukan update data']);
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        //redirect to index
        return redirect()->route('peminjaman.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
