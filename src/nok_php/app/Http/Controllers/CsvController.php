<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use SplFileObject;
use Illuminate\Support\Facades\Log;


class CsvController extends Controller
{
    /**
     * 初期表示
     *
     * @return void
     */
    public function index()
    {
        return view('csv_upload');
    }
    
    /**
     * csvエクスポート
     *
     * @return void
     */
    public function export()
    {
        // コールバックに一行ずつ書き込んでいく
        $callBack = function () {

            // 出力バッファ（出力データを一時的に記憶しておくためのもの）を開ける
            // php://output = 書き込み専用のストリームで出力バッファへの書き込みを許可する
            $stream = fopen('php://output', 'w');

            // // UTF-8だと文字化けしてしまうので文字コードをShift-JISに変換する
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

            // ヘッダーを指定
            fputcsv($stream, [
                '商品ID',
                '商品名'
            ]);

            // productsテーブルからcursorメソッドを使って1レコードずつストリームに流す処理をする
            // 一気に全件取得してしまうと、メモリが足りなくなってしまう為cursorメソッドを使用しメモリ消費を抑える
            $products = Product::cursor();

            foreach ($products as $product) {
                fputcsv($stream, [
                    $product->id,
                    $product->product_name
                ]);
            }
            // $streamを閉じる
            fclose($stream);
        };

        Log::debug('callBack');

        // 保存するファイル名を指定
        $products_data = sprintf('全商品データ.csv', date('Ymd'));

        // ファイルをダウンロードさせるためにヘッダー出力を調整
        $header = [
            // MIMEタイプと呼ばれるもののひとつ
            // ファイルの種類は気にするな！っていう指定
            'Content-Type' => 'application/octet-stream',
        ];

        // responseに返ってきた値をstreamDownloadメソッドを使いダウンロード可能なレスポンスに変換
        return response()->streamDownload($callBack, $products_data, $header);
    }


    /**
     * csvインポート
     *
     * @param Request $request
     * @return void
     */
    public function import(Request $request)
    {
        $validated = $request->validate(
            [
                'csvData' => 'required'
            ],
            [
                'csvData.required' => 'ファイルを選択してください'
            ]
        );
        // インポートされたファイルを取得
        $csv_data = $request->file('csvData');

        // ファイルのパスを取得
        $file_path = $request->file('csvData')->path($csv_data);

        // ファイルを読み込むためにSplFileObjectを使用する
        $csv_file = new SplFileObject($file_path);

        // READ_CSVを使用してファイルの中身の行を読み込む
        $csv_file->setFlags(SplFileObject::READ_CSV);

        $count = 1;
        foreach ($csv_file as $row) {

            // 一行目はヘッダーなので飛ばす（そのため上記の$count = 1 を指定）
            if ($count > 1) {

                // もし行が空だったらスキップする
                if ($row === [null]) continue; 

                // $product_nameに行の配列の1つめ（商品名）の値を入れる + 文字化け対策
                $product_name = mb_convert_encoding($row[1], 'UTF-8', 'SJIS');

                // 一行づづDBに追加していく
                Product::create([
                    'product_name' => $product_name,
                ]);
            }

            // カウントをプラスして次の行へ
            $count ++;
        }

        return redirect()->route('dashboard.index')->with('completeMessage', 'CSVをインポートしました！');
    }
}
