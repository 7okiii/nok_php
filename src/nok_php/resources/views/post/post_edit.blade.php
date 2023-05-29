<x-app-layout>
    <x-slot:viteRef>
        @vite(['resources/js/post.js', 'resources/js/product.js', 'node_modules/quill/dist/quill.snow.css'])
    </x-slot:viteRef>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿') }}
        </h2>
    </x-slot:header>
    <div class="bg-white w-full overflow-hidden shadow-md sm:rounded-lg mb-5">
        <div class="p-6 text-gray-900">
            <span class="text-lg font-semibold text-lime-600">投稿編集</span>
            <form method="POST" action="{{ route('post.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="text" name="id" class="hidden" value="{{ $post->id }}">
                <div class="flex flex-col mb-5">
                    <label for="">タイトル</label>
                    <input type="text" name="title" class="h-9 w-80 text-black rounded-md" value="{{ $post->title }}">
                </div>
                <div class="flex flex-col h-60 mb-5">
                    <label for="">内容</label>
                    <div id="quill_editor">{!! $post->contents !!}</div>
                    <input type="text" id="contents_input" name="contents" class="hidden" value="{{ $post->contents }}">
                </div>
                <div class="flex flex-col mb-5">
                    <label for="">画像追加</label>
                    <input type="file" name="upload_images[]" multiple>
                    <div class="flex flex-wrap items-center">
                        @foreach ($images as $image)
                            <div class="relative w-1/2 p-1">
                                {{-- <a href="/post/delete/image/{{ $image->id }}" class="delete_image absolute top-3 right-3"><i class="fa-regular fa-circle-xmark text-lg text-red-500 bg-gray-100 rounded-full hover:brightness-125"></i></a> --}}
                                <i class="delete_image fa-regular absolute top-3 right-3 fa-circle-xmark text-lg text-red-500 bg-gray-100 rounded-full hover:brightness-125" id="deleteImage_{{ $image->id }}"></i>
                                <img class="border-2 border-sky-300" src="{{ asset($image->image_path) }}"  alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-between">
                    <x-button class="px-7 py-2 bg-gradient-to-r from-cyan-600 to-sky-700">完了</x-button>
                    <a href="/post/destroy/{{ $post->id }}" class="deleteBtn px-7 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:brightness-110">削除</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>