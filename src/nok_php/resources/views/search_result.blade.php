<x-app-layout>
    <x-slot:viteRef>
        @vite(['resources/js/product.js'])
    </x-slot:viteRef>
    <x-products-table :allProducts="$results"/>
    {{-- <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-white">検索結果</h2>
            <div class="bg-white overflow-hidden mt-1 shadow-md sm:rounded-lg">
                <div class="p-3 sm:p-6 text-gray-900 w-full">
                    <table class="grid table-auto w-full border-[1px] border-white">
                        <tbody class="rounded-lg">
            
                            <tr class="grid grid-cols-6 items-center bg-gradient-to-br from-gray-600 to-gray-800 h-10 border-[1px] border-gray-800 text-white drop-shadow-lg rounded-t-sm">
                                <th class="col-span-3 sm:col-span-2">商品ID</th>
                                <th class="col-span-3 sm:col-span-2">商品名</th>
                                <th class="hidden sm:grid sm:col-span-1">編集</th>
                                <th class="hidden sm:grid sm:col-span-1">削除</th>
                            </tr>
                            @foreach ($results as $result)
                                <tr class="grid grid-cols-6 items-center odd:bg-white even:bg-gray-100 border-b-[1px] border-x-[1px] border-gray-500 last:rounded-b-sm" id="row_{{ $result->id }}">
                                    <td class="col-span-3 p-2 sm:col-span-2 text-center">
                                        <input type="text" id="{{ $result->id }}" value="{{ $result->id }}" class="text-center w-full bg-transparent outline-none border-none rounded-lg" readonly>
                                    </td>
                                    <td class="col-span-3 sm:col-span-2 text-center">
                                        <input type="text" value="{{ $result->product_name }}" id="product_name_{{ $result->id }}" class="product_name w-full text-center bg-transparent outline-none border-none rounded-lg" readonly>
                                    </td>
                                    <td class="col-span-3 sm:col-span-1 text-center">
                                        <x-button class="showOkBtn px-3 py-1.5 bg-gradient-to-tr from-lime-500 to-green-600" id="showOkBtn_{{ $result->id }}">編集</x-button>
                                        <x-button class="clickClass px-3 py-1.5 bg-gradient-to-tr from-teal-500 to-green-600 hidden" id="product_{{ $result->id }}">OK</x-button>
                                    </td>
                                    <td class="col-span-3 sm:col-span-1 text-center">
                                        <x-button class="deleteBtn px-3 py-1.5 bg-gradient-to-tr from-rose-500 to-red-600" id="deleteBtn_{{ $result->id }}">削除</x-button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </tbody>
                    <div class="mt-5">
                        {{ $results->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>