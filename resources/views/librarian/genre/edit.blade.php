<x-app-layout>
    <div class="w-full flex justify-center">
      <form method = "post" action="{{route('librarian.genres.update', ['genre'=>$genre->id])}}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @method('PUT')
        @csrf
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            Name
          </label>
          <input value="{{$genre->name}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="name" name = "name">
        </div>
  
        <label for="style" class="block mb-2 text-sm font-medium text-gray-900">Select an option</label>
        <select multiple id="style" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" name="style">
          <option>Choose styles</option>
          <option value="primary" @if($genre->style == "primary") selected @endif>primary</option>
          <option value="secondary" @if($genre->style == "secondary") selected @endif>secondary</option>
          <option value="success" @if($genre->style == "success") selected @endif>success</option>
          <option value="danger" @if($genre->style == "danger") selected @endif>danger</option>
          <option value="warning" @if($genre->style == "warning") selected @endif>warning</option>
          <option value="info" @if($genre->style == "info") selected @endif>info</option>
          <option value="light" @if($genre->style == "light") selected @endif>light</option>
          <option value="dark" @if($genre->style == "dark") selected @endif>dark</option>
        </select>
  
        <div class="flex justify-center my-2">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Update
          </button>
        </div>
      </form>
    </div>
  </x-app-layout>
  