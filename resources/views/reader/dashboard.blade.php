<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-2 mb-2">
                <form class="max-w-md mx-auto" method="GET" id="title-search-form">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input name="keyword" type="search" id="title-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search By Title..." required />
                        <button id="title-search-button" type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search By Title</button>
                    </div>
                </form>
                
                <form class="max-w-md mx-auto" method="GET" id="authors-search-form">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input name="keyword" type="search" id="authors-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search By Authors..." required />
                        <button id="authors-search-button" type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search By Authors</button>
                    </div>
                </form>
                
                <form id="genre-search-form" class="flex space-x-2 max-w-sm mx-auto" method="GET" action="">
                    <select id="genre" name="genre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option >Select Genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{$genre->id}}">{{$genre->name}}</option>
                    @endforeach
                    </select>
                    <button id="authors-search-button" type="submit" class="w-60 text-white end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search By Genre</button>
                </form>
  
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Total Readers
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Books
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Genres
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Active Book Rentals
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$total_readers}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$total_books}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$total_genres}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$active_rent}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    titleSearchInput = document.querySelector('#title-search');
    authorsSearchInput = document.querySelector('#authors-search');
    genreSearchOption = document.querySelector('#genre');

    titleSearchForm = document.querySelector('#title-search-form');
    authorsSearchForm = document.querySelector('#authors-search-form');
    genreSearchForm = document.querySelector('#genre-search-form');

    titleSearchForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const titleKeyword = titleSearchInput.value;
        if(titleKeyword == ""){
            return;
        }
        const titleRoute = '{{ route("reader.books.filtered-by-title", ["keyword" => ":titleKeyword"]) }}'
        titleSearchForm.action = titleRoute.replace(':titleKeyword', titleKeyword);
        titleSearchForm.submit();
    })

    authorsSearchForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const authorsKeyword = authorsSearchInput.value;
        if(authorsKeyword == ""){
            return;
        }
        const authorsRoute = '{{ route("reader.books.filtered-by-authors", ["keyword" => ":authorsKeyword"]) }}'
        authorsSearchForm.action = authorsRoute.replace(':authorsKeyword', authorsKeyword);
        authorsSearchForm.submit();
    })

    genreSearchForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const genre_id = genreSearchOption.value;
        if(genre_id == null){
            return;
        }
        const genreRoute = '{{ route("reader.books.filtered-by-genre", ["genre" => ":genre_id"]) }}'
        genreSearchForm.action = genreRoute.replace(':genre_id', genre_id);
        genreSearchForm.submit();
    })
</script>