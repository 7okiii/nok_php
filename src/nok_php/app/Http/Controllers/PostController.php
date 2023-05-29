<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * 初期表示
     *
     * @return void
     */
    public function index()
    {
        $posts = Post::all();
        return view('post.post', compact('posts'));
    }


    /**
     * 新規投稿
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        // ログインしているユーザーのIDを取得
        $user_id = Auth::id();

        // 新規投稿の際のバリデーション
        $validated = $request->validate(
            [
                'title' => 'required',
                'contents' => 'required'
            ],
            [
                'title.required' => 'タイトルは必須です',
                'contents.required' => '内容は必須です',
            ]
        );

        // タイトル・詳細・画像のパスを取得
        $title = $request->title;
        $contents = $request->contents;

        // 画像アップロードがあった場合の処理
        if ($request->file('upload_images')) {
            // アップロードされた画像ファイルを取得し$image_filesに入れる
            $image_files = $request->file('upload_images');

            // 画像のパスをDBに保存するために配列を用意
            $path_array = [];

            foreach($image_files as $image_file) {
                // ファイル名を取得
                $file_name = $image_file->getClientOriginalName();

                // storage/app/public/images　配下に取得したファイル名で保存
                $image_file->storeAs('public/images', $file_name);

                // DB保存用のパスを生成（storage/images/画像のpathで表示できる）
                $image_paths = 'storage/images/'.$file_name;

                // パスを配列に入れていく
                array_push($path_array, $image_paths);
            }
        }

        // 戻り値の $return に返ってくるidをimages_tableのpost_idとして使用
        $return = Post::create([
            'user_id' => $user_id,
            'title' => $title,
            'contents' => $contents,
            'contents_of_html' => $contents,
            'post_type_id' => 1,
            'is_display' => 1,
            'created_user_id' => $user_id,
            'updated_user_id' => $user_id,
        ]);


        // 画像のパスが格納されている $path_array がある場合以下の処理を実行
        if (isset($path_array)) {
            $post_id = $return->id;
            foreach($path_array as $image_path) {
                Image::create([
                    'post_id' => $post_id,
                    'image_path' => $image_path
                ]);
            }
        }
        return redirect()->route('post.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // リレーションを使用して images_table から対象データを取得
        $images = $post->images;

        return view('post.post_edit', compact('post', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // タイトル・詳細・画像のパスを取得
        $id = $request->id;
        $title = $request->title;
        $contents = $request->contents;

        if ($request->file('upload_images')) {
            // アップロードされた画像ファイルを取得し$image_filesに入れる
            $image_files = $request->file('upload_images');

            // 画像のパスをDBに保存するために配列を用意
            $path_array = [];

            foreach($image_files as $image_file) {
                // ファイル名を取得
                $file_name = $image_file->getClientOriginalName();

                // storage/app/public/images　配下に取得したファイル名で保存
                $image_file->storeAs('public/images', $file_name);

                // DB保存用のパスを生成（storage/images/画像のpathで表示できる）
                $image_paths = 'storage/images/'.$file_name;

                // パスを配列に入れていく
                array_push($path_array, $image_paths);
            }

            foreach($path_array as $image_path) {
                Image::create([
                    'post_id' => $id,
                    'image_path' => $image_path
                ]);
            }
        }

        // 既にDBに登録されている画像のパスを取得
        $db_img_path = Post::where('id', $id)->get()->first()->img_path;

        Post::where('id', $id)->update([
            'title' => $title,
            'contents' => $contents,
            'contents_of_html' => $contents,
            'post_type_id' => 1,
            'is_display' => 1,

            // 新しい画像登録リクエストがあればそれを、なければ既に登録済みのものを、登録されていなければNULLを登録する
            'img_path' => $image_path ?? $db_img_path ?? NULL
        ]);

        return redirect()->route('post.index');
    }

    /**
     *  投稿削除
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('post.index');
    }

    // 非同期処理投稿一覧画面から
    public function delete(Request $request)
    {
        $post_id = (int)$request->post_id;
        Post::destroy($post_id);
    }

    /**
     * 投稿画像削除
     *
     * @param [type] $id
     * @return void
     */
    public function deleteImage($id)
    {
        Image::destroy($id);

        // 削除前編集画面のリンクを取得
        $pre_url = url()->previous();

        // 削除後編集画面に遷移
        return redirect($pre_url);
    }
}