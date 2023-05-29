<div {{ $attributes->merge([ 'class' => 'bg-white w-full overflow-hidden shadow-md sm:rounded-lg mb-5']) }}>
    <div class="p-6 text-gray-900">
        <span class="text-lg font-semibold text-sky-600">新規投稿</span>
        <form method="POST" action="{{ route('post.create') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col mb-5">
                <label for="">タイトル<span class="text-red-600">*</span></label>
                <input type="text" name="title" class="h-9 w-80 text-black rounded-md" value="{{ old('title') }}">
                @if ($errors->any())
                    <span class="text-red-600">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div class="flex flex-col h-60 mb-2">
                <label for="">内容<span class="text-red-600">*</span></label>
                <div id="quill_editor"></div>
                <input type="text" id="contents_input" name="contents" class="hidden">
                @if ($errors->any())
                    <span class="text-red-600">{{ $errors->first('contents') }}</span>
                @endif
            </div>
            <div class="flex flex-col mb-5">
                <label for="">画像</label>
                <input type="file" name="upload_images[]" multiple>
            </div>
            <x-button class="px-7 py-2 bg-gradient-to-r from-cyan-600 to-sky-700">投稿</x-button>
        </form>
    </div>
</div>