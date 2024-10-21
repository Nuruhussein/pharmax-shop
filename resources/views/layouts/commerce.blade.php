<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'pharmax') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
 {{-- @vite('resources/js/cart.js') --}}
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/cart.js','resources/js/app.js'])

    <!-- Include jQuery before your custom scripts if using CDN -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body class="max-w-screen-2xl mx-auto">
    @if (!request()->is('payment/success/*'))
<header class="shadow-md top-0 z-50 max-w-screen-2xl fixed w-full mb-16 bg-white" id='nav'>
    <div class="px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <div class="flex-shrink-0">
                <a href="#" title="" class="flex">
                    <img class="w-auto h-16" src="https://th.bing.com/th/id/R.47b05b1a9609e27246898478bc3dc5ad?rik=EYTJ7VM4PKfc4Q&pid=ImgRaw&r=0" alt="" />
                </a>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button 
                type="button" 
                class="inline-flex p-1 text-black transition-all duration-200 border border-black lg:hidden focus:bg-gray-100 hover:bg-gray-100"
                onclick="toggleMenu()"
            >
                <!-- Toggle Menu Icon -->
                <svg id="menu-icon-open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="menu-icon-close" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Desktop Menu -->
            <div class="hidden ml-auto lg:flex lg:items-center lg:justify-center lg:space-x-10">
          <div class="relative group inline-block">
    <button class="text-base font-semibold text-black transition-all duration-200 hover:text-opacity-80">
        Categories
    </button>
    <div class="opacity-0 invisible group-hover:opacity-100 group-hover:visible absolute w-72 mt-2 bg-white text-gray-800 border border-gray-300 rounded-lg shadow-lg py-2 z-10 grid grid-cols-2 gap-2">
        @foreach($categories as $category)
            <a href="{{ route('ecommerce.category.show', $category->id) }}" class="flex items-center px-4 py-2 hover:bg-gray-100 transition-all duration-200">
                <div class="w-12 h-12 mr-2 overflow-hidden rounded-full">
                    @if($category->photo)
                        <img src="{{ asset('storage/' . $category->photo) }}" alt="{{ $category->name }}" class="object-cover w-full h-full">
                    @else
                        <img src="https://dummyimage.com/720x400" alt="default" class="object-cover w-full h-full">
                    @endif
                </div>
                <span>{{ $category->name }}</span>
            </a>
        @endforeach
    </div>
</div>


{{-- <a href="#features" class="text-base font-semibold text-black transition-all duration-200 hover:text-opacity-80">Categories</a> --}}


                @if (request()->is('ecommerce'))
                    <a href="#feauters" class="text-base font-semibold text-black transition-all duration-200 hover:text-opacity-80">Features</a>
                @else
                    <a href="/ecommerce" class="text-base font-semibold text-black transition-all duration-200 hover:text-opacity-80">Home</a>
                    <a href="/ecommerce#feauters" class="text-base font-semibold text-black transition-all duration-200 hover:text-opacity-80">Features</a>
                @endif
                <a href="{{ route('ecommerce.about') }}" class="text-base font-semibold text-black transition-all duration-200 hover:text-opacity-80">About Us</a>
                <a href="{{ route('ecommerce.shop') }}" class="text-base font-semibold text-black transition-all duration-200 hover:text-opacity-80">Shopping</a>
                @if (request()->is('ecommerce'))
                    <a href="#store" class="text-base font-semibold text-black transition-all duration-200 hover:text-opacity-80">Store</a>
                @else
                    <a href="/ecommerce#store" class="text-base font-semibold text-black transition-all duration-200 hover:text-opacity-80">Store</a>
                @endif
                <div class="w-px h-5 bg-black/20"></div>

                <!-- Cart - Visible on larger screens, hidden on mobile -->
                <a href="{{ route('cart') }}" class="fixed bottom-24 right-16 text-gray-300 m-0 p-0 hidden lg:block">
                    <span id="cart-count" class="absolute bottom-14 -right-7 z-10 font-bold text-white text-xl rounded-full bg-red-500 w-8 h-8 flex items-center justify-center">
                        {{ count((array) session('cart')) }}
                    </span>
                    <i class="fas fa-shopping-cart absolute bottom-10 right-3 z-0 w-6 h-6 text-5xl text-blue-400 dark:text-white"></i>
                </a>

                @if (Auth::check())
                    <!-- Messages - Visible on larger screens, hidden on mobile -->
                    <a href="{{ route('messages.inbox') }}" class="fixed bottom-10 right-14 text-gray-300 m-0 p-0 hidden lg:block">
                        <i class="fas fa-comments absolute bottom-5 right-3 w-6 h-6 text-blue-400 text-3xl z-0 shadow-2xl dark:text-white"></i>
                    </a>
                @endif

                @if (Auth::check())
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <i class="fa-solid text-green-500 text-xl fa-user"></i>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @if (Auth::user()->role === 'doctor')
                                    <x-dropdown-link :href="route('orders.index')">
                                        {{ __('Orders') }}
                                    </x-dropdown-link>
                                @elseif (Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
                                    <x-dropdown-link :href="route('dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>
                                @endif

                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-base font-semibold text-black transition-all duration-200 hover:text-opacity-80">Log in</a>
                @endif

                <a href="#contact" class="inline-flex items-center justify-center px-5 py-2.5 text-base font-semibold text-black border-2 border-black hover:bg-black hover:text-white transition-all duration-200 focus:bg-black focus:text-white">Contact us</a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden">
            <div class="flex flex-col mt-4 space-y-3 text-sm text-black">
                @if (request()->is('ecommerce'))
                    <a href="#feauters" class="block text-gray-500 font-semibold text-2xl transition-all duration-200 hover:text-opacity-80">Features</a>
                @else
                    <a href="/ecommerce" class="block text-gray-500 font-semibold text-2xl  transition-all duration-200 hover:text-opacity-80">Home</a>
                    <a href="/ecommerce#feauters" class="block text-gray-500 font-semibold text-2xl transition-all duration-200 hover:text-opacity-80">Features</a>
                @endif
                <a href="{{ route('ecommerce.about') }}" class="block text-gray-500 text-2xl font-semibold transition-all duration-200 hover:text-opacity-80">About Us</a>
                <a href="{{ route('ecommerce.shop') }}" class="block text-gray-500 text-2xl font-semibold transition-all duration-200 hover:text-opacity-80">Shopping</a>
                <a href="#contact" class="block text-2xl text-gray-500 font-semibold transition-all duration-200 hover:text-opacity-80">Contact us</a>
                
                @if (request()->is('ecommerce'))
                    <a href="#store" class="block font-semibold text-gray-500 text-2xl transition-all duration-200 hover:text-opacity-80">Store</a>
                @else
                    <a href="/ecommerce#store" class="block text-gray-500 text-2xl font-semibold transition-all duration-200 hover:text-opacity-80">Store</a>
                @endif

                @if (Auth::check())
                    <div class="mt-4">
                        <a href="{{ route('profile.edit') }}" class="block text-blue-400 text-2xl font-semibold transition-all duration-200 hover:text-opacity-80">Profile</a>
                        <a href="{{ route('logout') }}" class="block font-semibold text-blue-400 text-2xl transition-all duration-200 hover:text-opacity-80"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                            @csrf
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="block text-2xl font-semibold transition-all duration-200 hover:text-opacity-80">Log in</a>
                @endif

            </div>
        </div>

        <!-- Mobile Icons for Cart and Messages -->
        <div class="fixed bottom-28  right-8 flex justify-around lg:hidden">
            <a href="{{ route('cart') }}" class="text-gray-300">
                <span id="cart-count" class="absolute bottom-5 -right-3 z-10 font-bold text-white text-xl rounded-full bg-red-500 w-6 h-6 flex items-center justify-center">
                    {{ count((array) session('cart')) }}
                </span>
                <i class="fas fa-shopping-cart text-3xl text-blue-400"></i>
            </a>

            @if (Auth::check())
                <a href="{{ route('messages.inbox') }}" class=" absolute top-11 text-gray-300">
                    <i class="fas fa-comments text-3xl text-blue-400"></i>
                </a>
            @endif
        </div>
    </div>
</header>


<script>
    function toggleMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        const openIcon = document.getElementById('menu-icon-open');
        const closeIcon = document.getElementById('menu-icon-close');

        mobileMenu.classList.toggle('hidden');
        openIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    }
</script>

@endif
    @yield('content')

    @yield('scripts')



    {{-- footer --}}
  <section class="py-10 bg-gray-50 sm:pt-16 shadow-lg lg:pt-24">
    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid grid-cols-2 md:col-span-3 lg:grid-cols-6 gap-y-16 gap-x-12">
            <div class="col-span-2 md:col-span-3 lg:col-span-2 lg:pr-8">
                <img class="w-auto h-9" src="https://th.bing.com/th/id/R.47b05b1a9609e27246898478bc3dc5ad?rik=EYTJ7VM4PKfc4Q&pid=ImgRaw&r=0" alt="" /><span>pharmax-shop</span>

                <p class="text-base leading-relaxed text-gray-600 mt-7">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</p>

                <ul class="flex items-center space-x-3 mt-9">
                    <li>
                        <a href="#" title="" class="flex items-center justify-center text-white transition-all duration-200 bg-gray-800 rounded-full w-7 h-7 hover:bg-blue-600 focus:bg-blue-600">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"
                                ></path>
                            </svg>
                        </a>
                    </li>

                    <li>
                        <a href="#" title="" class="flex items-center justify-center text-white transition-all duration-200 bg-gray-800 rounded-full w-7 h-7 hover:bg-blue-600 focus:bg-blue-600">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path>
                            </svg>
                        </a>
                    </li>

                    <li>
                        <a href="#" title="" class="flex items-center justify-center text-white transition-all duration-200 bg-gray-800 rounded-full w-7 h-7 hover:bg-blue-600 focus:bg-blue-600">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z"></path>
                                <circle cx="16.806" cy="7.207" r="1.078"></circle>
                                <path
                                    d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z"
                                ></path>
                            </svg>
                        </a>
                    </li>

                    <li>
                        <a href="#" title="" class="flex items-center justify-center text-white transition-all duration-200 bg-gray-800 rounded-full w-7 h-7 hover:bg-blue-600 focus:bg-blue-600">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M12.026 2c-5.509 0-9.974 4.465-9.974 9.974 0 4.406 2.857 8.145 6.821 9.465.499.09.679-.217.679-.481 0-.237-.008-.865-.011-1.696-2.775.602-3.361-1.338-3.361-1.338-.452-1.152-1.107-1.459-1.107-1.459-.905-.619.069-.605.069-.605 1.002.07 1.527 1.028 1.527 1.028.89 1.524 2.336 1.084 2.902.829.091-.645.351-1.085.635-1.334-2.214-.251-4.542-1.107-4.542-4.93 0-1.087.389-1.979 1.024-2.675-.101-.253-.446-1.268.099-2.64 0 0 .837-.269 2.742 1.021a9.582 9.582 0 0 1 2.496-.336 9.554 9.554 0 0 1 2.496.336c1.906-1.291 2.742-1.021 2.742-1.021.545 1.372.203 2.387.099 2.64.64.696 1.024 1.587 1.024 2.675 0 3.833-2.33 4.675-4.552 4.922.355.308.675.916.675 1.846 0 1.334-.012 2.41-.012 2.737 0 .267.178.577.687.479C19.146 20.115 22 16.379 22 11.974 22 6.465 17.535 2 12.026 2z"
                                ></path>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <p class="text-sm font-semibold tracking-widest text-gray-400 uppercase">Company</p>

                <ul class="mt-6 space-y-4">
                     <li>
                        <a href="/ecommerce" title="" class="flex text-base text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600"> Home </a>
                    </li>
                     <li>
                        <a  href="{{ route('ecommerce.about') }}" title="" class="flex text-base text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600"> About </a>
                    </li>

                    <li>
                        <a href="/ecommerce#feauters" title="" class="flex text-base text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600"> Features </a>
                    </li>

                    <li>
                        <a href="/ecommerc#contact" title="" class="flex text-base text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600"> contact us </a>
                    </li>

                  
                </ul>
            </div>

            <div>
                <p class="text-sm font-semibold tracking-widest text-gray-400 uppercase">Help</p>

                <ul class="mt-6 space-y-4">
                    <li>
                        <a href="#" title="" class="flex text-base text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600"> Customer Support </a>
                    </li>

                    <li>
                        <a href="#" title="" class="flex text-base text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600"> Delivery Details </a>
                    </li>

                    <li>
                        <a href="#" title="" class="flex text-base text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600"> Terms & Conditions </a>
                    </li>

                    <li>
                        <a href="#" title="" class="flex text-base text-black transition-all duration-200 hover:text-blue-600 focus:text-blue-600"> Privacy Policy </a>
                    </li>
                </ul>
            </div>

         <div class="col-span-2 md:col-span-1 lg:col-span-2 lg:pl-8">
                <p class="text-sm font-semibold tracking-widest text-gray-400 uppercase">Popular Categories</p>
                <p class="text-xs mt-9 w-64 font-semibold tracking-widest text-gray-400 uppercase"> Get best categories from our store</p>
                    <a href="/ecommerce#category" class="inline-flex items-center justify-center px-6 py-2 cursor-pointer mt-4 font-semibold text-white transition-all duration-200 bg-gradient-to-r from-fuchsia-600 to-blue-600 rounded-md hover:bg-blue-700 focus:bg-blue-700">Get best</a>
               
              
            </div> 
        </div>

        <hr class="mt-16 mb-10 border-gray-200" />

        <p class="text-sm text-center text-gray-600">© Copyright 2021, All Rights Reserved by Postcraft</p>
    </div>
</section>

</body>
</html>



