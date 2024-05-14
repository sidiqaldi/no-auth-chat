<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        @vite(['resources/css/app.css'])
    </head>
    <body class="bg-gray-900">
        <div class="py-8 px-4 flex mx-auto min-h-screen max-w-screen-xl lg:py-16 lg:px-6 items-center">
            <div class="mx-auto max-w-screen-sm text-center">
                <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-500">404</h1>
                <p class="mb-4 text-3xl tracking-tight font-bold  md:text-4xl text-white">Something's missing.</p>
                <p class="mb-4 text-lg font-light text-gray-400">Sorry, we can't find that page. You'll find lots to explore on the home page. </p>
                <a href="{{ route('rooms') }}" class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center focus:ring-primary-900 my-4">Back to Search</a>
            </div>
        </div>
    </body>
</html>