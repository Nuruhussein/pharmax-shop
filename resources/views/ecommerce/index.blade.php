@extends('layouts.commerce')

@section('content')

   <div class="bg-gradient-to-b ">
 
{{-- @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ session('success') }}
    </div>
@endif --}}

    <section class="py-10 sm:py-16 lg:py-24">
        <div class="px-4 mt-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2">
                <div>
                    <h1 class="text-4xl font-bold text-black sm:text-6xl lg:text-7xl">
                        Acess your Health , with
                        <div class="relative inline-flex">
                            {{-- <span class="absolute inset-x-0 bottom-0 border-b-[30px] border-[#4ADE80]"></span> --}}
                            <h1 class="relative text-4xl font-bold text-black sm:text-6xl lg:text-7xl">pharmax-shop</h1>
                        </div>
                    </h1>

                    <p class="mt-8 text-base text-black sm:text-xl">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat.</p>

                    <div class="mt-10 sm:flex sm:items-center sm:space-x-8">
                        {{-- <a href="#" title="" class="inline-flex items-center justify-center px-10 py-4 text-base font-semibold text-white  duration-200  hover:bg-orange-600 focus:bg-orange-600  bg-orange-600" role="button"> Start exploring </a> --}}
                        {{-- <button  class=" items-center justify-center px-16 mr-8 py-3 text-base font-semibold text-white transition-all duration-200 hover:bg-orange-600 focus:bg-orange-600" style="background-color: #F97316;" > Start exploring </button> --}}
                         <a href="#getstart" title="" class="inline-flex items-center justify-center px-5 py-4 mt-8 text-base font-semibold text-white transition-all duration-200 rounded-md hover:opacity-90 focus:opacity-90 lg:mt-auto bg-gradient-to-r from-fuchsia-600 to-blue-600" role="button">
                    Get started now
                    <svg class="w-5 h-5 ml-8 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
                {{-- /* From Uiverse.io by nathAd17 */  --}}
<a href="{{ route('ecommerce.shop') }}"
  class="font-sans flex justify-center gap-2 items-center mx-auto shadow-xl text-lg bg-gray-50 backdrop-blur-md lg:font-semibold isolation-auto border-gray-50 before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0 before:rounded-full before:bg-emerald-500 hover:text-gray-50 before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700 relative z-10 px-4 py-2 overflow-hidden border-2 rounded-full group"
  type="submit"
>

  Shope Now
  <svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 16 19"
    class="w-8 h-8 justify-end group-hover:rotate-90 group-hover:bg-gray-50 text-gray-50 ease-linear duration-300 rounded-full border border-gray-700 group-hover:border-none p-2 rotate-45"
  >
    <path
      class="fill-gray-800 group-hover:fill-gray-800"
      d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z"
    ></path>
  </svg>
</a>

                        {{-- <a href="#" title="" class="inline-flex items-center mt-6 text-base font-semibold transition-all duration-200 sm:mt-0 hover:opacity-80">
                            <svg class="w-10 h-10 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path fill="#F97316" stroke="#F97316" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Watch video
                        </a> --}}
                    </div>
                </div>

                <div>
                    
                    <div class="relative">
    <img class="w-64 animate-pulse rounded-full z-10 absolute top-0 left-0" src="https://th.bing.com/th/id/OIP.6t39rqGtAzPnc35mZ59rpgHaEP?rs=1&pid=ImgDetMain" alt="" />
    <img class="w-full z-0" src="https://th.bing.com/th/id/R.99400b6481d40b2997bcfc96b1f83f84?rik=dmYSeVUOU4AcdA&pid=ImgRaw&r=0" alt="" />
</div>

                   
                </div>
            </div>
        </div>
    </section>
</div>



{{-- categories --}}

<section id="category" class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex items-end py-9 justify-between">
            <div class="flex-1 text-center lg:text-left">
                <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl lg:text-5xl">Latest from Category</h2>
                <p class="max-w-xl mx-auto mt-4 text-base leading-relaxed text-gray-600 lg:mx-0">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis.</p>
            </div>
{{-- 
            <div class="hidden lg:flex lg:items-center lg:space-x-3">
                <button type="button" class="flex items-center justify-center text-gray-400 transition-all duration-200 bg-transparent border border-gray-300 rounded w-9 h-9 hover:bg-blue-600 hover:text-white focus:bg-blue-600 focus:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <button type="button" class="flex items-center justify-center text-gray-400 transition-all duration-200 bg-transparent border border-gray-300 rounded w-9 h-9 hover:bg-blue-600 hover:text-white focus:bg-blue-600 focus:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div> --}}
            <div class="mt-4">
    {{ $categories->links() }}
</div>
        </div>

        <div class="flex flex-wrap -m-4">
            @foreach($categories as $category)
                <div class="p-4 md:w-1/3">
                    <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                        @if($category->photo)
                            <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('storage/' . $category->photo) }}" alt="category photo">
                        @else
                            <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="https://dummyimage.com/720x400" alt="category photo">
                        @endif
                        <div class="p-6">
                            {{-- <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">{{ $category->name }}</h2> --}}
                            <h1 class="title-font text-lg font-medium text-gray-400 mb-3">{{ $category->name }}</h1>
                            <p class="leading-relaxed mb-3">{{ $category->description ?? 'No description available.' }}</p>
                            <div class="flex items-center flex-wrap ">
                                <a href="{{ route('ecommerce.category.show', $category->id) }}" class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More
                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                                <span class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>1.2K
                                </span>
                                <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                    </svg>6
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


{{-- chmari1 --}}
<section class="py-10 bg-gray-50 sm:py-16 lg:py-24">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid items-stretch gap-y-10 md:grid-cols-2 md:gap-x-20">
            <div class="relative grid grid-cols-2 gap-6 mt-10 md:mt-0">
                <div class="overflow-hidden aspect-w-3 aspect-h-4">
                    <img class="object-cover object-top origin-top scale-150" src="https://th.bing.com/th/id/OIP.WO7niT25dFv9kLZri1rq_gHaHa?w=856&h=856&rs=1&pid=ImgDetMain" alt="" />
                </div>

                <div class="relative">
                    <div class="h-full overflow-hidden aspect-w-3 aspect-h-4">
                        <img class="object-fill  scale-150 lg:origin-bottom-right" src="https://th.bing.com/th/id/OIP.ROWyAE9vzQFkmcuHcmQd3QHaJQ?rs=1&pid=ImgDetMain" alt="" />
                    </div>

                    <div class="absolute inset-0 grid w-full h-full place-items-center">
                        <button type="button" class="inline-flex items-center justify-center w-12 h-12 text-blue-600 bg-white rounded-full shadow-md lg:w-20 lg:h-20">
                            <svg class="w-6 h-6 lg:w-8 lg:h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M8 6.82v10.36c0 .79.87 1.27 1.54.84l8.14-5.18c.62-.39.62-1.29 0-1.69L9.54 5.98C8.87 5.55 8 6.03 8 6.82z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="absolute -translate-x-1/2 left-1/2 -top-16">
                    <img class="w-32 h-32" src="https://cdn.rareblocks.xyz/collection/celebration/images/features/2/round-text.png" alt="" />
                </div>
            </div>

            <div class="flex flex-col items-start xl:px-16">
                <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl lg:text-5xl"> Experience health solutions, with.</h2>
                <p class="mt-4 text-base leading-relaxed text-gray-600">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>

            @if(Auth::check())
    <a href="{{ route('ecommerce.shop') }}" title="" class="inline-flex items-center justify-center px-5 py-4 mt-8 text-base font-semibold text-white transition-all duration-200 rounded-md hover:opacity-90 focus:opacity-90 lg:mt-auto bg-gradient-to-r from-fuchsia-600 to-blue-600" role="button">
        Start Shopping
        <svg class="w-5 h-5 ml-8 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </a>
@else
    <a href="{{ route('login') }}" title="" class="inline-flex items-center justify-center px-5 py-4 mt-8 text-base font-semibold text-white transition-all duration-200 rounded-md hover:opacity-90 focus:opacity-90 lg:mt-auto bg-gradient-to-r from-fuchsia-600 to-blue-600" role="button">
        Get started now
        <svg class="w-5 h-5 ml-8 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </a>
@endif

            </div>
        </div>
    </div>
</section>



<!-- source: https://github.com/mfg888/Responsive-Tailwind-CSS-Grid/blob/main/index.html -->

<div id="store" class="text-center p-10 bg-gradient-to-r from-gray-50 to-white text-gray-700 rounded-lg">
    <h1 class="font-bold text-4xl mb-4">Featured Products</h1>
    <h1 class="text-3xl">Shop Now</h1>
</div>

<section id="Medicines" class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-14">
    @foreach ($medicines as $medicine)
    <!-- Medicine card -->
    <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="{{ asset('storage/'.$medicine->image) }}" alt="Medicine Image" class="h-80 w-72 object-cover rounded-t-xl" />
            <div class="px-4 py-3 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Medicine</span>
                <p class="text-lg font-bold text-black truncate block capitalize">{{ $medicine->name }}</p>
                <div class="flex items-center justify-between">
                    <p class="text-lg font-semibold text-black cursor-auto my-3">${{ $medicine->price }}</p>
                    <!-- Add to Cart Button -->
                    <a href="#" data-id="{{ $medicine->id }}" class="add-to-cart relative mx-auto py-3 px-4 transition-all duration-200 ease-in-out border-none bg-transparent cursor-pointer group">
                        <span class="relative z-10 font-ubuntu text-lg font-bold tracking-wide text-[#234567]">Add to Cart</span>
                        <i class="fas fa-arrow-right ml-2 text-[#234567]"></i>
                        <span class="absolute top-0 left-0 block rounded-full bg-gradient-to-r from-fuchsia-100 to-blue-600 w-11 h-11 transition-all duration-300 ease-in-out group-hover:w-full"></span>
                    </a>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</section>

<div class="mt-4 mb-4 flex justify-center">
    {{ $medicines->links('vendor.pagination.tailwind') }}
</div>






{{-- chmari2 --}}
<section class="py-10 bg-gray-50 sm:py-16 lg:py-24">
    <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">
        <div class="grid items-center md:grid-cols-2 md:gap-x-20 gap-y-10">
            <div class="relative pl-16 pr-10 sm:pl-6 md:pl-0 xl:pr-0 md:order-2">
                <img class="absolute top-6 -right-4 xl:-right-12" src="https://cdn.rareblocks.xyz/collection/celebration/images/features/3/dots-pattern.svg" alt="" />

                <div class="relative max-w-xs ml-auto">
                    <div class="overflow-hidden aspect-w-3 aspect-h-4">
                        <img class="object-cover w-full h-full scale-150" src="https://plus.unsplash.com/premium_photo-1661770294094-06167872e079?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fHBoYXJtYWN5fGVufDB8fDB8fHww" alt="" />
                    </div>

                    <div class="absolute bottom-0 -left-16">
                        <div class="bg-yellow-300">
                            <div class="py-4 pl-4 pr-10 sm:py-6 sm:pl-8 sm:pr-16">
                                <svg class="w-9 sm:w-14 h-9 sm:h-14" xmlns="http://www.w3.org/2000/svg" fill="#FFF" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <span class="block mt-3 text-xl font-bold text-black sm:mt-6 sm:text-4xl lg:text-5xl"> 2,984 </span>
                                <span class="block mt-2 text-sm font-medium leading-snug text-amber-900 sm:text-base"> Customer chat<br />served on July </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:order-1">
                <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl lg:text-5xl">keep upto dated  with us.</h2>
                <p class="mt-4 text-base leading-relaxed text-gray-600">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>

                <a href="/messages/inbox" title="" class="inline-flex items-center justify-center px-8 py-3 mt-8 text-base font-semibold text-white transition-all duration-200 bg-gradient-to-r from-fuchsia-600 to-blue-600 rounded-md hover:bg-blue-700 focus:bg-blue-700" role="button"> messaging with us</a>
            </div>
        </div>
    </div>
</section>

{{-- 

/////medicines --}}

  
<section id='getstart' class=" py-8 antialiased dark:bg-gray-900 md:py-12">
  @foreach ($categories as $category)
   <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <!-- Heading & Filters -->
       
    <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
 
       <div class="flex"><h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">        {{ $category->name }}
       </h2>
              
        <svg class="h-5 mt-5 ml-3 w-5 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                </svg></div>
      
      
    </div>
    
     
    <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
   
  
      
    @foreach ($category->medicines as $medicine)
  <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="{{ asset('storage/'.$medicine->image) }}" alt="Medicine Image" class="h-80 w-72 object-cover rounded-t-xl" />
            <div class="px-4 py-3 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Medicine</span>
                <p class="text-lg font-bold text-black truncate block capitalize">{{ $medicine->name }}</p>
                <div class="flex items-center justify-between">
                    <p class="text-lg font-semibold text-black cursor-auto my-3">${{ $medicine->price }}</p>
                    <!-- Add to Cart Button -->
                    <a href="#" data-id="{{ $medicine->id }}" class="add-to-cart relative mx-auto py-3 px-4 transition-all duration-200 ease-in-out border-none bg-transparent cursor-pointer group">
                        <span class="relative z-10 font-ubuntu text-lg font-bold tracking-wide text-[#234567]">Add to Cart</span>
                        <i class="fas fa-arrow-right ml-2 text-[#234567]"></i>
                        <span class="absolute top-0 left-0 block rounded-full bg-gradient-to-r from-fuchsia-300 to-blue-600 w-11 h-11 transition-all duration-300 ease-in-out group-hover:w-full"></span>
                    </a>
                </div>
            </div>
        </a>
    </div>
  @endforeach
       
    </div>
    {{-- <div class="w-full text-center">
      <button type="button" class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Show more</button>
    </div> --}}
  </div>
      @endforeach
  <!-- Filter modal -->
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
                    // alert(response.message);
                },
                error: function(response) {
                    // alert('Failed to add item to cart.');
                }
            });
        });
    });
</script>

@include('ecommerce.components.feauters')

  {{-- footer --}}

</section>
@endsection
