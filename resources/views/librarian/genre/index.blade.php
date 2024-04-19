<x-app-layout>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Style
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($genres as $genre)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$genre->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{$genre->style}}
                    </td>
                    <td class="px-6 py-4">
                        <button class="border px-2 py-1 rounded-lg bg-white text-black" onclick="window.location.href = '{{ route('librarian.genres.edit', ['genre' => $genre->id]) }}'">Edit</button>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{route('librarian.genres.destroy', ['genre' => $genre->id])}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button class="border px-2 py-1 rounded-lg bg-white text-black">Archive</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>