<p align="right"><a href="{{ route('buku.create') }}">Tambah Buku</a></p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Tanggal Terbit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data_buku as $buku)
            <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                <td>{{ $buku->tgl_terbit }}</td>
                <td>
                <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                    @csrf 
                    <button onclick="return confirm('yakin mau dihapus?')">Hapus</button>
                </form>
                </td>
                <td>
                    <a href="{{ route('buku.edit', $buku->id) }}">Edit Buku</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<p>Total Buku : {{ $totalbuku }}</p>
<p>Total Harga : {{ $total }}</p>