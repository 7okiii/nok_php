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
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-emerald-600">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="post/destroy/{{ $post->id }}" class="deleteBtn cursor-pointer text-center" id="deletePost">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-400 cursor-pointer">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>  
                                        </a>
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