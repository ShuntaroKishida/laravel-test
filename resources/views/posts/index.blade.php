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
    <h1><a href="{{ route('posts.index') }}">Laravel News</a></h1>
    <h2>ニュース投稿</h2>
    <form id="postForm">
        @csrf

        <label for="title">タイトル:</label>
        <input type="text" name="title" id="title">
        <div id="titleError"></div>

        <label for="message">投稿内容:</label>
        <textarea name="message" id="message"></textarea>
        <div id="messageError"></div>

        <button type="submit">投稿する</button>

    </form>
    <h2>ニュース一覧</h2>
    <div id="newsList">
        @foreach ($posts as $post)
            <h3><a href="{{ route('posts.show', $post->id) }}">タイトル：{{ $post->title }}</a></h3>
            <p>内容：{{ $post->message }}</p>
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

            if (confirm('マジ投稿しちゃう？')) {
                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('posts.store') }}',
                    data: formData,
                    success: function(response) {
                        $('#title').val('');
                        $('#message').val('');
                        $('#titleError').empty();
                        $('#messageError').empty();

                        // 投稿データから詳細ページへのリンクを生成
                        var newPostHtml = '<h3><a href="' + '/posts/' + response.post.id + '">タイトル：' + response.post.title + '</a></h3><p>内容：' + response.post.message + '</p>';
                        $('#newsList').prepend(newPostHtml);
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        $('#titleError').text(errors.title ? errors.title[0] : '');
                        $('#messageError').text(errors.message ? errors.message[0] : '');
                    }
                });
            } else {
                return false;
            }
        });
    });
    </script>
</body>
</html>
