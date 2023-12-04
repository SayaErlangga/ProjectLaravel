@include('layout')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gallery') }}
        </h2>
    </x-slot>
    @if(session('pesan'))
            <div class="alert alert-success">
                {{ session('pesan') }}
            </div>
    @endif
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section id="album" class="py-1 bg-dark">
                        <div class="container">
                            <table>
                                <tr>
                                    <td rowspan="5">
                                        @if ( $buku->filepath )
                                            <div class="h-10 w-10">
                                                <img
                                                class="h-full w-full object-cover object-center"
                                                src="{{ asset($buku->filepath) }}"
                                                alt=""/>
                                            </div>
                                        @endif
                                    </td>
                                    <td><p class="h4 text-left ps-5">Judul Buku: {{ $buku->judul}}</p></td>
                                </tr>
                                <tr>
                                    <td><p class="h4 text-left ps-5">Tanggal Terbit: {{ $buku->tgl_terbit}}</p></td>
                                </tr>
                                <tr>
                                    <td><p class="h4 text-left ps-5">Penulis: {{ $buku->penulis}}</p></td>
                                </tr>
                                <tr>
                                    <td><p class="h4 text-left ps-5">Harga: {{ $buku->harga}}</p></td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="h4 text-left ps-5">
                                            Rating: 
                                            @php
                                                $ratings = $buku->rating;
                                                $averageRating = $ratings->isNotEmpty() ? $ratings->avg('rating') : null;
                                            @endphp

                                            @if ($averageRating !== null)
                                                {{ number_format($averageRating, 2) }}
                                            @else
                                                Rating is not available.
                                            @endif
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    @if (Auth::check())
                                        <form action="{{ route('buku.addToFavorite', $buku->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary mt-2">Simpan ke daftar favorit</button>
                                        </form>
                                    @endif
                                    </td>
                                </tr>

                            </table>
                            <br>
                                <p class="h2 text-center">Galeri {{ $buku -> judul }}</p>
                            <br>
                                <hr style="border-width: 5px">
                            <br>
                            <div class="row">
                                @foreach ($buku->galleries()->get() as $data)
                                <div class="col-md-4">
                                    <a href="{{ asset($data->path) }}"
                                    data-lightbox="image-1" data-title="{{ $data->keterangan }}">
                                    <img src="{{ asset($data->path) }}" style="width:200px; height:150px"></a>
                                    <p><h5>{{ $data->nama_galeri }}</h5></p>
                                </div>
                                @endforeach
                            </div>
                            <br>
                            <div class="text-end"><a href="{{ route('list-buku') }}" class="h4 btn btn-primary">Back</a></div>
                        </div>
                        <br>
                            <hr style="border-width: 5px">
                        <br>
                            <p class="h2 text-center">Berikan Review Buku {{ $buku -> judul }}</p>
                            <form action="{{ route('buku.rating', $buku->id) }}" method="POST" class="p-4">
                                @csrf
                                <select class="form-select" aria-label="Default select example" name="rating">
                                    <option disabled selected>Masukkan Rating</option>
                                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                            </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
