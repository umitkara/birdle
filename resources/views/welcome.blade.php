<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Twitter</title>
        <link rel="icon" href="{{ asset("img/favicon.svg") }}" type="image/svg+xml">
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            @font-face {
                font-family: 'TwitterChirpExtendedHeavy';
                src: url('{{ asset('webfonts/chirp-extended-heavy-web.woff') }}') format('woff');
            }
            .twitter-font {
                font-family: 'TwitterChirpExtendedHeavy', serif !important;
            }
        </style>
    </head>
    <body class="bg-[#1a202c] flex">
        <div class="h-screen w-7/12 relative">
            <div class="bg-blue-800 absolute h-screen w-full bg-opacity-20 flex items-center justify-center">
                <img class="w-1/3" src="{{ asset("img/logo.svg") }}" />
            </div>
            <img class="h-screen" src="https://picsum.photos/id/579/1200/980">
        </div>
        <div class="h-screen w-5/12 text-white p-3 flex flex-col justify-center">
            <h1 class="text-6xl mb-2 twitter-font">
                What's happening
            </h1>
            <h2 class="text-2xl whitespace-pre-line mb-4 twitter-font">
                Join to conversation,
                Join Twitter today.
            </h2>
            <div>
                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    Register
                </a>
            </div>
            <h2 class="text-2xl whitespace-pre-line mb-4 twitter-font">
                Already have an account?
            </h2>
            <div>
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    Login
                </a>
            </div>
        </div>
    </body>
</html>
