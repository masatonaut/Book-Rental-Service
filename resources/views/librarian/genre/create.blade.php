<x-app-layout>
  <div class="w-full flex justify-center">
    <form method = "post" action="{{route('librarian.genres.store')}}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      @csrf
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          Name
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="name" name = "name">
      </div>

      <label for="style" class="block mb-2 text-sm font-medium text-gray-900">Select an option</label>
      <select multiple id="style" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" name="style">
        <option selected>Choose styles</option>
        <option value="primary">primary</option>
        <option value="secondary">secondary</option>
        <option value="success">success</option>
        <option value="danger">danger</option>
        <option value="warning">warning</option>
        <option value="info">info</option>
        <option value="light">light</option>
        <option value="dark">dark</option>
      </select>

      <div class="flex justify-center my-2">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Submit
        </button>
      </div>
    </form>
  </div>
</x-app-layout>
