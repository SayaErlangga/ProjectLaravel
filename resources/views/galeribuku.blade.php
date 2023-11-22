@include('layout')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gallery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section id="album" class="py-1 bg-dark">
                        <div class="container">
                            <p class="h4 text-center">Buku: {{ $buku->judul}} </p>
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
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
