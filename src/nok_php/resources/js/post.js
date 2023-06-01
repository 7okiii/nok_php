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
        return false;
    }

    // OKが押された場合は true を返し削除処理を実行
    return true;
})

$('.delete_image').on('click', function (e) {
    Swal.fire({
        title: '本当に削除しますか？',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'OK'
    }).then((result) => {
        if(result.value) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            let id = e.target.id;
            let image_id = id.split("_")[1];

            $.ajax({
                method: "POST",

                url: "/post/delete/image",

                dataType: "html",

                data: {
                    image_id,
                }
            })
            .done((res) => {
                Swal.fire({
                    icon: 'success',
                    title: '削除が完了しました！',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if(result.value) {
                        window.location.reload();
                    }
                })
            })
            .fail((error) => {
                console.log(error);
                console.log("エラー");
            });
        }
    })
})


$('.deletePost').on('click', function (e) {
    Swal.fire({
        title: '本当に削除しますか？',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'OK'
    }).then((result) => {
        if(result.value) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            let id = e.target.id;
            let post_id = id.split("_")[1];

            // 一覧ページか編集ページか
            let page = id.split("_")[0];

            $.ajax({
                method: "POST",

                url: "/post/delete",

                dataType: "html",

                data: {
                    post_id,
                }
            })
            .done((res) => {
                Swal.fire({
                    icon: 'success',
                    title: '削除が完了しました！',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if(result.value) {
                        if(page != 'deleteEdit') {
                            window.location.reload();
                        }
                        window.history.back();
                        let reload = () => {
                            window.location.reload();
                        }
                        setTimeout(reload, 3000);
                    }
                })
            })
            .fail((error) => {
                console.log(error);
                console.log("エラー");
            });
        }
    })
})