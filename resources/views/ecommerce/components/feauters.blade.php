   <section id='feauters' class="py-10 bg-gray-50 sm:py-16 lg:py-24">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto text-center">
            <div class="inline-flex px-4 py-1.5 mx-auto rounded-full bg-gradient-to-r from-fuchsia-600 to-blue-600">
                <p class="text-xs font-semibold tracking-widest text-white uppercase">Quality Pharmacy Products</p>
            </div>
            <h2 class="mt-6 text-3xl font-bold leading-tight text-black sm:text-4xl lg:text-5xl">pharmax shop : Quality Products</h2>
            <p class="mt-4 text-base leading-relaxed text-gray-600">Experience top-quality medications with secured payment options. Shop with confidence and care.</p>
        </div>

        <div class="grid grid-cols-1 gap-5 mt-12 sm:grid-cols-3 lg:mt-20 lg:gap-x-12">
            <div class="transition-all duration-200 bg-white hover:shadow-xl">
                <div class="py-10 px-9">
                    <i class="fas fa-lock w-16 h-16 text-gray-400"></i>
                    <h3 class="mt-8 text-lg font-semibold text-black">Secured Payments</h3>
                    <p class="mt-4 text-base text-gray-600">Shop safely with our secure payment options, ensuring your transactions are protected.</p>
                </div>
            </div>

            <div class="transition-all duration-200 bg-white hover:shadow-xl">
                <div class="py-10 px-9">
                    <i class="fas fa-shopping-cart w-16 h-16 text-gray-400"></i>
                    <h3 class="mt-8 text-lg font-semibold text-black">Quality Products</h3>
                    <p class="mt-4 text-base text-gray-600">We offer a wide range of quality medications tailored to your health needs.</p>
                </div>
            </div>

            <div class="transition-all duration-200 bg-white hover:shadow-xl">
                <div class="py-10 px-9">
                    <i class="fas fa-truck w-16 h-16 text-gray-400"></i>
                    <h3 class="mt-8 text-lg font-semibold text-black">Fast Delivery</h3>
                    <p class="mt-4 text-base text-gray-600">Enjoy prompt delivery of your medications right to your door.</p>
                </div>
            </div>
        </div>
    </div>
</section>



{{-- contact us --}}

<main id="contact" class="py-14" x-data="contactComponent()">
    <div class="max-w-screen-xl mx-auto px-4 text-gray-600 md:px-8">
        <div class="max-w-xl space-y-3">
            <h3 class="text-indigo-600 font-semibold">Contact</h3>
            <p class="text-gray-800 text-3xl font-semibold sm:text-4xl">Let us know how we can help</p>
            <p>We’re here to help and answer any questions you might have. We look forward to hearing from you.</p>
        </div>
        <div>
            <ul class="mt-12 flex flex-wrap gap-x-12 gap-y-6 items-center lg:gap-x-24">
                <template x-for="(item, idx) in contactMethods" :key="idx">
                    <li>
                        <h4 class="text-gray-800 text-lg font-medium" x-text="item.title"></h4>
                        <div class="mt-3 flex items-center gap-x-3">
                            <div class="flex-none text-gray-400" x-html="item.icon"></div>
                            <p x-text="item.contact"></p>
                        </div>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</main>

<script>
function contactComponent() {
    return {
        contactMethods: [
            {
                icon: `<i class="fas fa-map-marker-alt fa-lg text-gray-400"></i>`,
                contact: "Adiss ababa, Ethipia, megenagna.",
                title: "Our Office"
            },
            {
                icon: `<i class="fas fa-phone fa-lg text-gray-400"></i>`,
                contact: "+25-19-45-42-09-49",
                title: "Phone"
            },
            {
                icon: `<i class="fas fa-envelope fa-lg text-gray-400"></i>`,
                contact: "Support@example.com",
                title: "Email"
            },
        ]
    }
}
</script>


