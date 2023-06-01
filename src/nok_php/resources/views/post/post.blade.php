<x-app-layout>
    <x-slot:viteRef>
        @vite(['resources/js/post.js', 'node_modules/quill/dist/quill.snow.css'])
    </x-slot:viteRef>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto">
            <x-post-form />
            <h2 class="text-white text-lg font-semibold">投稿一覧</h2>
            <div class="w-full bg-white rounded-lg p-5">
                @if ($posts->count() >= 1)
                    <table class="w-full table-auto">
                        <thead class="border-b border-cyan-600 drop-shadow-md">
                            <tr>
                                <th>タイトル</th>
                                <th>カテゴリー</th>
                                <th>作成日</th>
                                <th>更新日</th>
                                <th class="invisible">編集</th>
                                <th class="invisible">削除</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @foreach ($posts as $post)
                                <tr class="text-center border-b border-gray-300">
                                    <td class="py-2">{{ $post->title }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->updated_at }}</td>
                                    <td>
                                        <a href="post/edit/{{ $post->id }}" class="cursor-pointer text-center">
                                            <i class="fa-regular fa-pen-to-square text-emerald-500 text-lg hover:brightness-125"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <i class="deletePost fa-regular fa-trash-can text-red-500 text-lg hover:brightness-125" id="deletePost_{{ $post->id }}"></i>  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> 
                    </table>
                @else
                    <p class="text-red-400">投稿がありません</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>    