<div {{ $attributes->merge([ 'class' => 'bg-white w-full overflow-hidden shadow-md sm:rounded-lg mb-5']) }}>
    <div class="p-6 text-gray-900">
        <span class="text-lg font-semibold text-sky-600">新商品登録</span>
        <form method="POST" action="{{ route('product.create') }}">
            @csrf
            <div class="flex flex-col mb-2">
                <label for="">商品名</label>
                <input type="text" name="product_name" class="h-9 w-80 text-black rounded-lg">
            </div>
            @if ($errors->any())
                <div>
                    <span class="text-red-600">{{ $errors->first('product_name') }}</span>
                </div>
            @endif
            <x-button class="px-7 py-2 bg-gradient-to-r from-cyan-600 to-sky-700">登録</x-button>
        </form>
    </div>
</div>