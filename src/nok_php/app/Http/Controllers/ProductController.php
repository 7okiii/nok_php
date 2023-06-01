<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 初期表示
    public function index(Request $request)
    {
        // セレクトボックスからのrequestがある場合、その値を入れる
        if ($request->sort) {
            $sort = $request->sort;
        } else {
            // セレクトボックスからのrequestがない場合、初期値に new を入れる
            $sort = 'new';
        }

        if ($sort == 'new') {
            // セレクトボックスの値が new の場合、商品を新しい順に並び替える
            $allProducts = Product::where('deleted_at', null)->orderBy('id', 'desc')->paginate(10);
        } else {
            // セレクトボックスの値が old の場合、商品を古い順に並び替える
            $allProducts = Product::where('deleted_at', null)->orderBy('id', 'asc')->paginate(10);
        }

        return view('dashboard', compact('allProducts', 'sort'));
    }

    // 新商品登録
    public function create(Request $request)
    {
        // inputから入力値を受け取り$newProductに入れる
        // $newProduct = $request->product_name;
        $newProduct = $request->new_product;
        
        // Laravelのバリデーションを使用しinput(product_name)を入力必須にする
        // バリデーションの結果は$errorsに自動で保管されるのでview側でどこでも使用できる
        // $request->validate([
        //     'product_name' => 'required'
        // ],
        // [
        //     'product_name.required' => '商品名を入力してください'
        // ]);

        Product::create([
            'product_name' => $newProduct
        ]);

        // 保存後データベースから全データを取得
        $allProducts = Product::all();

        return redirect()->route('dashboard.index', compact('allProducts'));
    }


    // 商品名変更＆保存
    public function update(Request $request)
    {
        // idが編集ボタンが持つIDと同じプロダクトを$productに代入
        $product = Product::find($request->product_id);

        // 対象の商品名にajaxで送られてきたinputの値を代入
        $product->product_name = $request->product_name;

        // 変更を保存
        $product->update();

        return redirect()->route('dashboard.index');
    }


    // 対象商品削除
    public function destroy(Request $request)
    {
        // destroyで該当のレコードを削除
        $product_id = (int)$request->product_id;
        Product::destroy($product_id);
    }

    // 商品検索
    public function search(Request $request)
    {
        // inputから入力された値を受け取る
        $keyword = $request->keyword;
        
        // DBにある全商品データを取得
        $allProducts = Product::query();

        // キーワードに入力がない場合は、全商品を返す
        if($keyword == '') {
            $results = Product::paginate(10);
            return view('search_result', compact('results'));
        } else {
            $results = $allProducts->where('product_name', 'LIKE', "%{$keyword}%")->paginate(15);
            return view('search_result', compact('results'));
        }
    }

    public function sort(Request $request) {

        $sortOrder = $request->sortOrder;

        // dd($sortOrder);

        if ($sortOrder == "new") {

            // セレクトボックスの値が new の場合、商品を新しい順に並び替える
            $allProducts = Product::orderBy('id', 'desc')->paginate(10);
        } else {
            
            // セレクトボックスの値が old の場合、商品を古い順に並び替える
            $allProducts = Product::orderBy('id', 'asc')->paginate(10);
        }
        return view('dashboard', compact('allProducts', 'sortOrder'));
    }
}