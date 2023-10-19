@include('layout')
<div class="container">
<h4>Tambah Buku</h4>

@if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
        @endforeach
@endif

<form action="{{route('buku.store')}}" method="POST">
    @csrf
    <div>Judul
        <input type="text" name="judul">
    </div>
    <div>Penulis
        <input type="text" name="penulis">
    </div>
    <div>Harga
        <input type="text" name="harga">
    </div>
    <div>Tgl. Terbit
        <input type="date" name="tgl_terbit">
    </div>
    <div><button type="submit">Simpan</button></div>
    <a href="/mahasiswa"> Batal</a>
</form>
</div>