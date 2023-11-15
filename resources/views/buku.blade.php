@include('layout')
    <p align="right"><a href="{{ route('buku.create') }}">Tambah Buku</a></p>
    @if(Session::has('pesan'))
        <div class="alert alert-success">{{ Session::get('pesan') }}</div>
    @endif
    <form action="{{ route('buku.search') }}" method="get">
        @csrf
        <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="width: 30%;
        display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>thumbnail</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                @if(Auth::check() && Auth::user() -> level == 'admin')
                <th colspan="2">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($data_buku as $buku)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>
                        @if ( $buku->filepath )
                            <div class="h-10 w-10">
                                <img
                                class="h-full w-full object-cover object-center"
                                src="{{ asset($buku->filepath) }}"
                                alt=""/>
                            </div>
                        @endif
                    </td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ $buku->tgl_terbit }}</td>
                    @if(Auth::check() && Auth::user() -> level == 'admin')
                    <td>
                    <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                        @csrf 
                        <button onclick="return confirm('yakin mau dihapus?')">Hapus</button>
                    </form>
                    </td>
                    <td>
                        <a href="{{ route('buku.edit', $buku->id) }}">Edit Buku</a>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">{{ $data_buku->links() }}</div>
    <p>Total Buku : {{ $totalbuku }}</p>
    <p>Total Harga : {{ "Rp ".number_format($total, 2, ',', '.') }}</p>
