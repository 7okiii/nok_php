<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Naoki</title>

        {{-- 全ページで利用するファイルの読み込み --}}
        @vite(['resources/css/app.css', 'resources/sass/style.scss', 'resources/assets/fontawesome/css/all.css', 'resources/js/app.js'])

        {{-- 各ページのjs読み込み --}}
        {{ $viteRef ?? '' }}
    </head>
    <body class="font-sans antialiased">
        <div class="bg-main min-h-screen">
            @include('layouts.navigation')

            {{-- ヘッダー --}}
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            {{-- メイン --}}
            <main class="px-3 sm:px-6 lg:px-8 py-3 sm:py-10">
                {{ $slot }}
            </main>
        </div>

        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    </body>
</html>
