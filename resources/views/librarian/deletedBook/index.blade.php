<x-app-layout>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Deleted at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$book->title}}
                    </th>
                    <td class="px-6 py-4">
                        {{$book->deleted_at}}
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{route('librarian.deleted-book.restore', ['book' => $book->id])}}" method="POST">
                            @csrf
                            <button class="border px-2 py-1 rounded-lg bg-white text-black">Restore</button>
                        </form>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{route('librarian.deleted-book.destroy', ['book' => $book->id])}}" method="POST">
                            @csrf
                            <button class="border px-2 py-1 rounded-lg bg-white text-black">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$books->links()}}
    </div>
</x-app-layout>