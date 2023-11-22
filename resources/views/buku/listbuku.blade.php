@include('layout')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>thumbnail</th>
                                    <th>Judul Buku</th>
                                    <th>Detail Buku</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data_buku as $buku)
                                <tr>
                                    <td>
                                        @if ( $buku->filepath )
                                            <div>
                                                <img
                                                class="h-full w-50 object-cover object-center"
                                                src="{{ asset($buku->filepath) }}"
                                                alt=""/>
                                            </div>
                                        @endif
                                    </td>
                                    <td><div>{{ $buku->judul }}</div></td>
                                    <td><a href="{{ route('galeri.buku', $buku->id) }}">Detail Buku</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>