<x-app-layout>
    @if(session('error'))
        <div class="bg-red-500 text-white p-4 mb-4">
            {{ session('pesan') }}
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buku Favoritku') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section id="album" class="py-1 bg-dark">
                        <div class="container">
                            <div style="display: flex; flex-wrap: wrap;">
                                @foreach ($favoriteBooks as $favoriteBook)
                                    <div style="margin: 10px;">
                                        @if ($favoriteBook->filepath)
                                            <img class="object-cover object-center" width="150px" src="{{ asset($favoriteBook->filepath) }}" alt="" />
                                        @endif
                                        <p>{{ $favoriteBook->judul }} by {{ $favoriteBook->penulis }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
