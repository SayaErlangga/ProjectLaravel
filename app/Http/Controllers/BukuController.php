<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Gallery;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batas = 5;
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        $totalbuku = Buku::count('id');
        $total = Buku::sum('harga');

        return view('buku', compact('data_buku', 'no', 'total', 'totalbuku'));
    }

    public function dashboard()
    {
        $batas = 5;
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        $totalbuku = Buku::count('id');
        $total = Buku::sum('harga');

        return view('dashboard', compact('data_buku', 'no', 'total', 'totalbuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'judul' => 'required|string',
        //     'penulis' => 'required|string|max:30',
        //     'harga' => 'required|numeric',
        //     'tgl_terbit' => 'required|date'
        // ]);

        $request->validate([
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->storeAs('public/uploads', $filename);

            $thumbnailPath = 'uploads/' . $filename;

            $image = Image::make(storage_path('app/public/' . $thumbnailPath))->fit(240, 320);
            $image->save();
        }

        $book = Buku::create([
            'judul' => $request->nama,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
            'filename' => $filename,
            'filepath' => '/storage/'. $thumbnailPath
        ]);

        if ($request->hasFile('gallery')) {
            foreach($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                Image::make(storage_path('app/public/uploads/' . $fileName));

                $gallery = Gallery::create([
                    'nama_galeri'   => $fileName,
                    'foto'          => $fileName,
                    'buku_id'       => $book->id,
                    'path'          => '/storage/' . $filePath,
                ]);
            }
        }

        return redirect('/dashboard')->with('pesan', 'Data Buku Berhasil di Simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);

        $request->validate([
            'thumbnail' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $filename = time() . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->storeAs('public/uploads', $filename);

            $thumbnailPath = 'uploads/' . $filename;

            $image = Image::make(storage_path('app/public/' . $thumbnailPath))->fit(240, 320);
            $image->save();

            $buku->update([
                'judul' => $request->nama,
                'penulis' => $request->penulis,
                'harga' => $request->harga,
                'tgl_terbit' => $request->tgl_terbit,
                'filename' => $filename,
                'filepath' => '/storage/'. $thumbnailPath
            ]);
        }

        $buku->update([
            'judul' => $request->nama,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);
        
        if ($request->hasFile('gallery')) {
            foreach($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                Image::make(storage_path('app/public/uploads/' . $fileName));

                $gallery = Gallery::create([
                    'nama_galeri'   => $fileName,
                    'foto'          => $fileName,
                    'buku_id'       => $id,
                    'path'          => '/storage/' . $filePath,
                ]);
            }
        }

        return redirect('/dashboard')->with('pesan', 'Data Buku Berhasil di Edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/dashboard')->with('pesan', 'Data Buku Berhasil di Hapus');
    }

    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', '%' . $cari . '%')->orwhere('penulis', 'like', '%' . $cari . '%')
            ->paginate($batas);
        $totalbuku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);
        $total = Buku::sum('harga');

        return view('search', compact('data_buku', 'no', 'total', 'totalbuku', 'cari'));
    }

    public function deleteGalleryImage($id)
    {
        $gallery = Gallery::find($id);

        // Delete the file from storage
        Storage::delete('public/' . $gallery->path);

        // Delete the gallery record from the database
        $gallery->delete();

        return redirect()->back()->with('pesan', 'Gambar Galeri Berhasil dihapus');
    }

    public function listbuku()
    {
        $batas = 5;
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        $totalbuku = Buku::count('id');
        $total = Buku::sum('harga');

        return view('buku.listbuku', compact('data_buku', 'no', 'total', 'totalbuku'));
    }

    public function galbuku($id){
        $buku = Buku::find($id);
        $batas = 5;
        $data_buku = Gallery::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        return view('galeribuku', compact('buku'));
    }

    public function rating(Request $request, string $id){
        $rating = Rating::create([
            'rating' => $request->rating,
            'buku_id' => $id
        ]);
        return redirect()->back()->with('pesan', 'Rating Berhasil Ditambahkan');
    }

    public function addToFavorite($id)
    {
        $user = Auth::user();
    
        // Ensure the user is logged in
        if ($user) {
            $buku = Buku::find($id);
    
            // Check if the book exists
            if ($buku) {
                // Check if the book is already in the user's favorites
                if (!$user->favoriteBooks->contains($buku->id)) {
                    // Attach the book to the user's favorites
                    $user->favoriteBooks()->attach($buku);
    
                    return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke daftar favorit.');
                } else {
                    return redirect()->back()->with('error', 'Buku sudah ada di daftar favorit Anda.');
                }
            } else {
                return redirect()->back()->with('error', 'Buku tidak ditemukan.');
            }
        }
    
        return redirect()->back()->with('error', 'Gagal menambahkan buku ke daftar favorit.');
    }
    

    public function myFavorite()
    {
        $user = Auth::user();

        // Ensure the user is logged in
        if ($user) {
            $favoriteBooks = $user->favoriteBooks;

            return view('myfavorite', compact('favoriteBooks'));
        }

        return redirect()->route('login')->with('error', 'Anda harus login untuk melihat buku favorit.');
    }

}
