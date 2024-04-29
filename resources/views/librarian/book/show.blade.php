<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="flex space-x-4 container px-5 py-24 mx-auto">
            <div class="w-1/2 flex flex-wrap">
                <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
                    <h2 class="text-sm title-font text-gray-500 tracking-widest">Title</h2>
                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">{{$book->title}}</h1>
                    <div class="flex mb-4">
                        <a class="flex-grow text-indigo-500 border-b-2 border-indigo-500 py-2 text-lg px-1">Description</a>
                    </div>
                    <p class="leading-relaxed mb-4">{{$book->description}}</p>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Authors</span>
                        <span class="ml-auto text-gray-900">{{$book->authors}}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Released at</span>
                        <span class="ml-auto text-gray-900">{{$book->released_at}}</span>
                    </div>
                    <div class="flex border-t border-gray-200 py-2">
                        <span class="text-gray-500">Pages</span>
                        <span class="ml-auto text-gray-900">{{$book->pages}}</span>
                    </div>
                    <div class="flex border-t border-b mb-6 border-gray-200 py-2">
                        <span class="text-gray-500">Language code</span>
                        <span class="ml-auto text-gray-900">{{$book->language_code}}</span>
                    </div>
                    <div class="flex border-t border-b mb-6 border-gray-200 py-2">
                        <span class="text-gray-500">isbn</span>
                        <span class="ml-auto text-gray-900">{{$book->isbn}}</span>
                    </div>
                    <div class="flex border-t border-b mb-6 border-gray-200 py-2">
                        <span class="text-gray-500">stock</span>
                        <span class="ml-auto text-gray-900">{{$book->in_stock}}</span>
                    </div>
                    <div class="flex">
                        <button class="border px-2 py-1 rounded-lg bg-white text-black" onclick="window.location.href = '{{ route('librarian.books.edit', ['book' => $book->id]) }}'">Edit</button>
                    </div>
                </div>
            </div>
            <img alt="ecommerce" class="object-cover object-center rounded" src="{{$book->cover_image}}">
        </div>
    </section>
</x-app-layout>