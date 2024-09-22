@extends('layouts.commerce')

@section('content')

<section class="bg-white mt-20   dark:bg-gray-900">
     <nav class="flex mb-4 text-center justify-start ml-24 pl-9 mt-6 items-center h-36 text-gray-600 ju  py-3 px-4 rounded-lg shadow-xs dark:bg-gray-800" aria-label="Breadcrumb">
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
                <span class="ml-2 text-xl">shop</span>
            </li>
        </ol>
    </nav>
    <div class="container px-6 py-8 mx-auto">
        <div class="lg:flex lg:-mx-2">
            <!-- Categories Sidebar -->
            <div class="space-y-3 overflow-y-auto lg:w-1/5 lg:px-2 lg:space-y-4">
                @foreach ($allCategories as $category)
                    <a href="#" data-category-id="{{ $category->id }}" 
                       class="category-link block font-medium text-gray-500 dark:text-gray-300 hover:underline {{ request()->query('category') == $category->id ? 'text-blue-600 dark:text-blue-500' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
         
            <!-- medicines Grid -->
            <div class="mt-6 lg:mt-0 lg:px-2 lg:w-4/5">
                
<div class="flex items-center justify-between text-sm tracking-widest uppercase">
    <p class="text-gray-500 dark:text-gray-300">{{ count($medicines) }} Items</p>
    <div class="flex items-center">
        <p class="text-gray-500 dark:text-gray-300">Sort</p>
    {{-- <form action="{{ route('ecommerce.index') }}" method="GET" id="sortForm"> --}}
            <select name="sort"  id="sortmedicines" onchange="document.getElementById('sortForm').submit();" class="font-medium text-gray-700 bg-transparent dark:text-gray-500 focus:outline-none">
                <option value="">Select</option>
                <option value="ascPrice" {{ request('sort') == 'ascPrice' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="descPrice" {{ request('sort') == 'descPrice' ? 'selected' : '' }}>Price: High to Low</option>
            </select>
        {{-- </form> --}}
    </div>
</div>
             <div  id="medicinesContainer">
                @include('ecommerce.partials.medicines', ['medicines' => $medicines])
             </div>
            </div>
         
        </div>
    </div>
</section>
   <script>
    document.getElementById('sortmedicines').addEventListener('change', function() {
        var sortValue = this.value;

        // AJAX request
        fetch(`?sort=${sortValue}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('medicinesContainer').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    });





    $(document).ready(function() {
        $('.category-link').on('click', function(e) {
            e.preventDefault(); // Prevent the default link behavior

            var categoryId = $(this).data('category-id');

            $.ajax({
                url: "{{ route('ecommerce.index') }}",
                method: 'GET',
                data: {
                    category: categoryId
                },
                success: function(response) {
                    $('#medicinesContainer').html(response);

                    // Update active category link style
                    $('.category-link').removeClass('text-blue-600 dark:text-blue-500');
                    $('[data-category-id="' + categoryId + '"]').addClass('text-blue-600 dark:text-blue-500');
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                }
            });
        });
    });
</script>
@endsection