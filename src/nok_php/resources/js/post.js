// quillに入力されたデータを仮のinputに入れLaravelで取得できるようにする処理
// quill自体を取得
let editor = document.getElementById('quill_editor');

// quillのデータを入れる空inputを取得
let contentsInput = document.getElementById('contents_input');

let quill = new Quill('#quill_editor', {
    theme: 'snow'
});

// quillで用意されているtext-changeイベントを使用
quill.on('text-change', function() {

    // quillエディタに入力されたデータを取得し editorHTML に入れる
    let editorHtml = editor.querySelector('.ql-editor').innerHTML;

    // hiddenで隠しているデータ取得用のinputに取得したエディタのデータを入れる
    contentsInput.value = editorHtml;
})

// 投稿削除前に確認するための処理
$('#deletePost').on('click', function (e) {
    
    // 削除をキャンセルした場合 false を返し削除処理を中止
    if(!window.confirm('本当に削除しますか？')) {
        window.alert('キャンセルされました');
        return false;
    }

    // OKが押された場合は true を返し削除処理を実行
    return true;
})