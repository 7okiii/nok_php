<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('post.post', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
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
        if ($request->file('upload_image')) {
            // アップロードされた画像ファイルを取得し$image_filesに入れる
            $image_file = $request->file('upload_image');

            // ファイル名を取得
            $file_name = $image_file->getClientOriginalName();

            // storage/app/public/images　配下に取得したファイル名で保存
            $image_file->storeAs('public/images', $file_name);

            // DB保存用のパスを生成（storage/images/画像のpathで表示できる）
            $image_path = 'storage/images/'.$file_name;

            // dd($image_path);
        }

        Post::create([
            'user_id' => $user_id,
            'title' => $title,
            'contents' => $contents,
            'contents_of_html' => $contents,
            'post_type_id' => 1,
            'is_display' => 1,
            'created_user_id' => $user_id,
            'updated_user_id' => $user_id,
            'img_path' => $image_path ?? ''
        ]);

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
    public function show($id)
    {
        $post = Post::find($id);

        return view('post.post_edit', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
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
    

        // 画像アップロードがあった場合の処理
        if ($request->file('upload_image')) {
            // ファイル名を取得
            $file_name = $request->file('upload_image')->getClientOriginalName();

            // storage/app/public/images　配下に取得したファイル名で保存
            $request->file('upload_image')->storeAs('public/images', $file_name);

            // DB保存用のパスを生成（storage/images/画像のpathで表示できる）
            $image_path = 'storage/images/'.$file_name;
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('post.index');
    }
}