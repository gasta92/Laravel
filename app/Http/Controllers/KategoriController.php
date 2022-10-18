<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //ambil data kategori
        $kategori = Kategori::latest()->paginate(2);

        // //render view dengan kategori
        return view('kategori.index', compact('kategori'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validasi formulir
        $this->validate($request, [
            'nama'     => 'required|min:3',
        ]);

        //create kategori
        $kategori = new Kategori;
        $kategori->nama = $request->nama;
        $kategori->save();

        //arahkan ke index
        return redirect()->route('kategori.index')->with(['success' => 'Kategori berhasil dibuat !']);
    }

    /**
     * edit
     *
     * @param  mixed $kategori
     * @return void
     */
    public function edit($id)
    {

        $kategori = Kategori::find($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $kategori
     * @return void
     */
    
    public function update($id, Request $request)
    {
        //validate form
        $this->validate($request, [
            'nama'     => 'required|min:3',
        ]);

        $kategori = Kategori::find($id);
        $kategori->nama = $request->nama;
        $kategori->save();

        //arahkan ke index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        //delete gambar
        Kategori::destroy($id);

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
