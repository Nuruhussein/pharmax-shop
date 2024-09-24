@extends('layouts.commerce')

@section('content')
<section class="py-10 bg-white sm:py-16 lg:py-24">
    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid items-center grid-cols-1 gap-y-12 lg:grid-cols-2 lg:gap-x-24">
            <!-- Image Section -->
            <div>
                <img class="w-full max-w-md mx-auto" src="https://th.bing.com/th/id/OIP.P0bsT-1JpBwjVzWIz3Fu4wHaHa?rs=1&pid=ImgDetMain" alt="Pharmacy services" />
            </div>

            <!-- Text Section -->
            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-bold leading-tight text-black sm:text-4xl lg:text-5xl">Empowering Your Health with Ease</h2>
                <p class="mt-6 text-base text-gray-600">Easily order medications and healthcare products online, with quick delivery options and secure payments through Chapa and other trusted methods.</p>

                <a href="{{ route('ecommerce.shop') }}" class="inline-flex items-center justify-center px-8 py-4 font-semibold text-white transition-all duration-200 bg-green-600 rounded-md mt-9 hover:bg-green-700 focus:bg-green-700" role="button"> Shop Now </a>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-600">
        <div class="space-y-8 lg:space-y-12">
            <!-- Section Title -->
            <h2 class="text-lg text-green-600 font-semibold uppercase">About Our Pharmacy</h2>
            <h3 class="text-4xl lg:text-5xl font-bold text-gray-800">Providing Quality Care Since 2014</h3>
            <p class="text-lg lg:text-xl text-gray-500 max-w-4xl mx-auto">
                Our pharmacy has been offering top-tier healthcare products and services since 2014. Whether you need prescription medications, over-the-counter products, or consultations, we are here to help you with fast, reliable service.
            </p>

            <!-- Mission Statement -->
            <h3 class="text-3xl lg:text-4xl font-bold text-gray-800">Our Mission</h3>
            <p class="text-lg lg:text-xl text-gray-500 max-w-4xl mx-auto">
                Our mission is to ensure that our customers receive the best healthcare products and services with convenience, integrity, and care. With easy online ordering and quick delivery, we aim to make healthcare accessible to everyone.
            </p>

            <!-- Why Choose Us -->
            <h3 class="text-3xl lg:text-4xl font-bold text-gray-800">Why Choose Us?</h3>
            <ul class="text-lg lg:text-xl text-gray-500 max-w-4xl mx-auto list-disc list-inside space-y-2">
                <li>A wide selection of medications and healthcare products.</li>
                <li>Secure online payments with Chapa and other trusted options.</li>
                <li>Fast, reliable delivery to your doorstep.</li>
                <li>Friendly, expert customer service.</li>
                <li>Transparent pricing with no hidden fees.</li>
            </ul>

            <!-- Contact Us Button -->
            <div class="mt-8">
               <a href="{{ route('ecommerce.index') }}#features" class="inline-flex items-center justify-center gap-x-2 py-3 px-6 text-lg font-semibold text-gray-700 hover:text-gray-500 border border-gray-300 rounded-lg">
    Contact Us
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-green-500">
        <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
    </svg>
</a>

            </div>
        </div>
    </div>
</section>

@endsection
