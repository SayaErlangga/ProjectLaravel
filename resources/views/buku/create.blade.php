<div class="container">
<h4>Tambah Buku</h4>
<form action="{{route('buku.store')}}" method="POST">
    @csrf
    <div>Judul
        <input type="text" name="nama">
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