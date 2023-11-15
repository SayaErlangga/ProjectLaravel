@include('layout')
<div class="container">
<h4>Edit Buku</h4>
<form action="{{route('buku.update', $buku->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input class="form-control" type="text" name="nama" value="{{$buku->judul}}">
    </div>
    <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input class="form-control" type="text" name="penulis" value="{{$buku->penulis}}">
    </div>
    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input class="form-control" type="text" name="harga" value="{{$buku->harga}}">
    </div>
    <div class="mb-3">
        <label class="form-label">Tgl. Terbit</label>
        <input class="form-control" type="date" name="tgl_terbit" value="{{$buku->tgl_terbit}}">
    </div>
    <div class="mb-3">
        <label class="form-label">Thumbnail</label>
        <input class="form-control" type="file" id="thumbnail" name="thumbnail">
    </div>
    <div class="mb-3">
        <label class="form-label">Gallery</label>
        <input class="form-control" type="file" id="gallery" name="gallery[]">
        <div id="tambahGallery">

        </div>    
    </div>
    <a class="mb-3" onclick="tambahData()">Tambah Galeri</a>

    <div class="mb-3">
        <button type="submit">Simpan</button>
        <a href="/dashboard"> Batal</a>
    </div>

    <div class="d-flex flex-wrap" id="gallery_item">
        @foreach($buku->galleries()->get() as $gallery)
            <div class="gallery_item">
                <img
                class="rounded-full object-cover object-center"
                src="{{ asset($gallery->path) }}"
                alt=""
                width="400"/>
                <a href="{{ route('deleteGalleryImage', ['id' => $gallery->id]) }}" class="mb-3" onclick="hapusData()">Hapus Data</a>
            </div>
        @endforeach
    </div>

    <script type="text/javascript">
        function tambahData() {
            var div = document.getElementById('tambahGallery');
            div.innerHTML += '<input class="form-control" type="file" id="gallery" name="gallery[]" class="mb-3">';
            };
    </script>
</form>
</div>
