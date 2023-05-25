<div class="w-full bg-white overflow-hidden shadow-md sm:rounded-lg mb-5">
    <div class="p-6 text-gray-900">
        <span class="text-lg font-semibold text-lime-600">商品検索</span>
        <form method="GET" action="{{ route('product.search') }}">
            @csrf
            <div class="flex flex-col mb-2">
                <label for="">キーワード</label>
                <input type="text" name="keyword" class="h-9 w-80 text-black rounded-lg">
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('keyword') as $error)
                            <li class="text-red-600">{{ __('messages.search_error') }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <x-button class="px-7 py-2 bg-gradient-to-r from-lime-600 to-lime-700">検索</x-button>
        </form>
    </div>
</div>