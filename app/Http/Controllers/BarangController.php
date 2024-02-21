<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get barang
        $barang = Barang::latest()->paginate(5);

        //render view with barang
        return view('barang.index', compact('barang'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $barang = Barang::all();
        return view('barang.create', compact('barang'));
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request, Barang $barang)
    {
        //validate form
         $this->validate($request, [
             'nama_barang'     => 'required',
             'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $image = $request->file('image');
    $image->storeAs('public/posts', $image->hashName());
        $barang->create([
            'nama_barang'=>$request->input('nama_barang'),
            'image'     => $image->hashName(),
        ]);



        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function edit(Barang $barang)
    {

        return view('barang.edit', compact('barang'));
    }

     /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Barang $barang)
{
    //validate form
    $this->validate($request, [
        'nama_barang' => 'required',
        'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $barang->update([
        'nama_barang' => $request->input('nama_barang'), // Corrected field name
        'image'       => $request->input('image'),
    ]);

    //redirect to index
    return redirect()->route('barang.index')->with(['success' => 'Berhasil melakukan update']);

    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
