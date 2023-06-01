<x-app-layout>
    <x-slot:viteRef>
        @vite(['resources/js/product.js'])
    </x-slot:viteRef>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto">

            <div class="flex justify-center items-center">
                {{-- 商品登録 --}}
                <x-register-box class="mr-2"/>

                {{-- 商品検索 --}}
                <x-search-box />
            </div>

            <div class="flex justify-between items-center mt-5">

                {{-- 商品並び替え用セレクトボックス --}}
                <form id="form">
                    <select name="sort" id="sort" class="rounded-lg bg-white">
                        <option id="sort_new" value="new" {{ $sort == 'new' ? 'selected' : '' }}>新しい順</option>
                        <option id="sort_old" value="old" {{ $sort == 'old' ? 'selected' : '' }}>古い順</option>
                    </select>
                </form>

                {{-- csv出力ボタン --}}
                <a href="/export_csv" class="text-white font-medium px-5 py-2 bg-gradient-to-tr from-orange-400 to-pink-500 outline-none focus:ring-1 hover:opacity-90 rounded-md">CSV出力</a>
            </div>

            {{-- 商品一覧 --}}
            <x-products-table :allProducts="$allProducts"/>
        </div>
    </div>
</x-app-layout>
