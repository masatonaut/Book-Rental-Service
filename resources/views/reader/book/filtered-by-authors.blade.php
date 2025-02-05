<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Books list
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-24 mx-auto">
                        <div class="flex flex-col text-center w-full mb-20">
                            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Search by authors</h1>
                            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{$keyword}}</p>
                        </div>
                        <div class="flex flex-wrap -m-4">
                            @foreach($books as $book)
                            <a href="{{route('librarian.books.show', ['book'=>$book->id])}}" class="lg:w-1/3 sm:w-1/2 p-4">
                                <div class="flex relative">
                                    <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center" src="{{$book->cover_image}}">
                                    <div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
                                        <h2 class="tracking-widest text-sm title-font font-medium text-indigo-500 mb-1">{{$book->title}}</h2>
                                        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{$book->authors}}</h1>
                                        <p class="leading-relaxed">{{$book->description}}</p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
            {{$books->links()}}
        </div>
    </div>
</x-app-layout>