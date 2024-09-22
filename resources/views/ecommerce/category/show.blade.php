@extends('layouts.commerce')

@section('content')

<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">

   <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
   
    <!-- Breadcrumb Navigation -->
    <nav class="flex mb-4 h-36 text-gray-600  py-3 px-4 rounded-lg shadow-xs dark:bg-gray-800" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/" class="text-xl text-gray-700 hover:text-gray-900 dark:hover:text-white">
                    <svg class="h-6 w-6 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l7-7 7 7M5 10v10a2 2 0 002 2h10a2 2 0 002-2V10"/>
                    </svg>
                    Home
                </a>
            </li>
            <li class="inline-flex items-center">
                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="ml-2 text-xl">{{ $category->name }}</span>
            </li>
        </ol>
    </nav>

    <!-- Heading & Filters -->
    {{-- <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
        <div class="flex items-center">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                {{ $category->name }}
            </h2>
        </div>
    </div> --}}

    <!-- Product Grid -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($category->medicines as $medicine)
        <div class="group rounded-lg border border-gray-200 bg-white p-6 shadow-sm hover:shadow-md dark:border-gray-700 dark:bg-gray-800 transition-shadow">
            <!-- Product Image -->
            <div class="h-56 w-full">
                <a href="#">
                    <img class="mx-auto h-full w-full object-cover rounded-md" src="{{ asset('storage/'.$medicine->image) }}" alt="{{ $medicine->name }}" />
                </a>
            </div>

            <!-- Product Details -->
            <div class="pt-4">
                <a href="#" class="block text-lg font-semibold text-gray-900 hover:underline dark:text-white">{{ $medicine->name }}</a>
                
                <!-- Product Price -->
                <div class="mt-3 flex items-center justify-between">
                    <p class="text-2xl font-extrabold text-gray-900 dark:text-white">${{ $medicine->price }}</p>
                    <a href="#" data-id="{{ $medicine->id }}" class="add-to-cart inline-flex items-center px-4 py-2 bg-gradient-to-r from-fuchsia-600 to-blue-600 text-white text-sm font-medium rounded-lg hover:from-blue-600 hover:to-fuchsia-600 focus:outline-none focus:ring-4 focus:ring-fuchsia-300 dark:focus:ring-fuchsia-800">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                        </svg>
                        Add to cart
                    </a>
                </div>
                
                <!-- Product Rating -->
                <div class="mt-2 flex items-center space-x-2">
                    @for ($i = 0; $i < 5; $i++)
                        <svg class="h-4 w-4 {{ $i < 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 .587l3.668 7.431L24 9.588l-6 5.832L19.336 24 12 20.313 4.664 24l1.336-8.58L0 9.588l8.332-1.57z"/>
                        </svg>
                    @endfor
                    <p class="text-sm font-medium text-gray-900 dark:text-white">4.8</p>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">(4,263)</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    {{-- <div class="mt-8 flex justify-center">
        <button type="button" class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
            Show more
        </button>
    </div> --}}
   </div>

    <!-- Add to Cart Script -->
    <script>
        $(document).ready(function() {
            $('.add-to-cart').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    url: '/add-to-cart/' + id,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#cart-count').text(response.cart_count);
                    },
                    error: function(response) {
                        alert('Failed to add item to cart.');
                    }
                });
            });
        });
    </script>

</section>
@endsection
