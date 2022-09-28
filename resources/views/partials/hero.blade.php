<section class="relative h-72 bg-sky-400 flex flex-col justify-center align-center text-center space-y-4 mb-4">
    <div class="absolute top-0 left-0 w-full h-full opacity-50 bg-no-repeat bg-center"
         style="background-image: url('/images/hero.jpg'); background-size: cover"></div>

    <div class="z-10">
        <h1 class="text-8xl font-extrabold italic font uppercase text-gray-800">
            BIT <span class="text-white">site</span>
        </h1>
        <p class="text-2xl text-gray-800 font-bold my-4">
           Get latest prices, buy and sell crypto!
        </p>
        <div>
            @auth
            @else
                <a href="/register"
                   class="inline-block border-2 border-gray-700 text-gray-700 py-2 px-4 rounded-xl uppercase mt-2 hover:text-gray-800 hover:border-gray-800">Sign
                    up to manage portfolio</a>
            @endauth
        </div>
    </div>
</section>
