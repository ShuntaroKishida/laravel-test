<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaravelNews</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="main_title">
        <h1><a href="{{ route('posts.index') }}">Laravel News</a></h1>
    </div>
    <h2>ニュース投稿</h2>
    <form id="postForm">
        @csrf
        <label for="title">タイトル:</label>
        <input type="text" name="title" id="title">
        @error('title')
            <div class="alert">{{ $message }}</div>
        @enderror
        <label for="message">投稿内容:</label>
        <textarea name="message" id="message"></textarea>
        @error('message')
            <div class="alert">{{ $message }}</div>
        @enderror
        <button type="submit">投稿する</button>
    </form>
    <h2>ニュース一覧</h2>
    <div id="newsList">
        @foreach ($posts as $post)
            <div class="post">
                <h3><a href="{{ route('posts.show', $post->id) }}">タイトル：{{ $post->title }}</a></h3>
                <p>内容：{{ $post->message }}</p>
            </div>
        @endforeach
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#postForm').submit(function(e) {
                e.preventDefault(); // デフォルトのフォーム送信を停止
                var formData = $(this).serialize(); // フォームデータをシリアライズ

                $.ajax({
                    type: 'POST',
                    url: '{{ route('posts.store') }}', // Laravel のルーティングを使用
                    data: formData,
                    success: function(response) {
                        alert('投稿が成功しました');
                        // フォームの入力値をクリア
                        $('#title').val('');
                        $('#message').val('');

                        // 新しい投稿をニュースリストの最上部に追加
                        $('#newsList').prepend('<div class="post"><h3>タイトル：' + response.post.title + '</h3><p>内容：' + response.post.message + '</p></div>');
                    },
                    error: function(response) {
                        alert('エラーが発生しました');
                    }
                });
            });
        });
    </script>
</body>
</html>
