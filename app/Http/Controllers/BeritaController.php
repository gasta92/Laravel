<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //ambil data berita
        $berita = Berita::latest()->paginate(5);
        
        //render view dengan berita
        return view('berita.index', compact('berita'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $kategori = Kategori::get();
        return view('berita.create',compact('kategori'));
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
            'kategori'     => 'required',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'judul'     => 'required|min:3',
            'isi'   => 'required|min:10'
        ]);

        //unggah gambar
        $image = $request->file('gambar');
        $image->storeAs('public/berita', $image->hashName());

        //create berita
        $berita = new Berita;
        $berita->idkategori = $request->kategori;
        $berita->gambar = $image->hashName();
        $berita->judul = $request->judul;
        $berita->isi = $request->isi;
        $berita->save();
        //arahkan ke index
        return redirect()->route('berita.index')->with(['success' => 'Berita berhasil dibuat !']);
    }

    /**
     * edit
     *
     * @param  mixed $berita
     * @return void
     */
    public function edit($id)
    {

        $berita = Berita::find($id);
        $kategori = Kategori::get();
        return view('berita.edit', compact('berita','kategori'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $berita
     * @return void
     */
    
    public function update($id, Request $request)
    {
        //validate form
        $berita = Berita::find($id);
        $this->validate($request, [
            'kategori'     => 'required',
            'gambar'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'judul'     => 'required|min:3',
            'isi'   => 'required|min:10'
        ]);

        //cek jika gambar telah di-unggah
        if ($request->hasFile('gambar')) {

            //unggah gambar baru
            $image = $request->file('gambar');
            $image->storeAs('public/berita', $image->hashName());

            //hapus gambar lama
            Storage::delete('public/berita/'.$berita->gambar);

            //perbaharui berita dengan gambar baru

            // $berita->update([
            //     'idkategori'     => $request->kategori,
            //     'gambar'     => $image->hashName(),
            //     'judul'     => $request->judul,
            //     'isi'   => $request->isi
            // ]);

            $berita->gambar = $image->hashName();
            $berita->idkategori = $request->kategori;
            $berita->judul = $request->judul;
            $berita->isi = $request->isi;

        } else {
            //perbaharui berita tanpa gambar
            $berita->judul = $request->judul;
            $berita->isi = $request->isi;
        }

        $berita->save();

        //arahkan ke index
        return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        //delete gambar
        $berita = Berita::find($id);
        Storage::delete('public/berita/'. $berita->gambar);

        //delete berita
        $berita->destroy($id);

        //redirect to index
        return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

}
