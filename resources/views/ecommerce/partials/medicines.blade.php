
<div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    @foreach ($medicines as $medicine)
        <div class="flex flex-col items-center justify-center w-full max-w-lg mx-auto">
            <img class="object-cover w-full rounded-md h-72 xl:h-80" src="{{ asset('storage/'.$medicine->image) }}" alt="{{ $medicine->name }}">
            <h4 class="mt-2 text-lg font-medium text-gray-700 dark:text-gray-200">{{ $medicine->name }}</h4>
            <p class="text-blue-500">${{ $medicine->price }}</p>

            <a href="#" data-id="{{ $medicine->id }}" class="add-to-cart flex items-center justify-center w-full px-2 py-2 mt-4 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-gradient-to-r from-fuchsia-600 to-blue-600 rounded-full" rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mx-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                </svg>
                <span class="mx-1">Add to cart</span>
            </a>
                   {{-- <a href="#" data-id="{{ $medicine->id }}" class="add-to-cart inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 bg-gradient-to-r from-fuchsia-600 to-blue-600 dark:focus:ring-primary-800" role="button">
    <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
    </svg>
    Add to cart
</a> --}}
        </div>
    @endforeach
</div>
