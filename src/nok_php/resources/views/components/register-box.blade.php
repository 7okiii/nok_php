<div {{ $attributes->merge([ 'class' => 'bg-white w-full overflow-hidden shadow-md sm:rounded-lg mb-5']) }}>
    <div class="p-6 text-gray-900">
        <span class="text-lg font-semibold text-sky-600">新商品登録</span>
            <div class="flex flex-col mb-2">
                <label for="">商品名</label>
                <input id="new_product" type="text" name="product_name" class="h-9 w-80 text-black rounded-lg">
            </div>
            <x-button id="register_new" class="px-7 py-2 bg-gradient-to-r from-cyan-600 to-sky-700">登録</x-button>
    </div>
</div>