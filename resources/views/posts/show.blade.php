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
    <h2>ニュース詳細</h2>
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->message }}</p>
    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('マジに削除？');">このニュースを削除する</button>
    </form>
    <h2>コメント投稿</h2>
    <form id="commentForm">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <textarea name="content" id="content"></textarea>
        <div id="contentError"></div>

        <button type="submit">コメントする</button>
    </form>
    <h2>コメント一覧</h2>
    <div id="commentsList">
        @foreach ($post->comments as $comment)
            <p>{{ $comment->content }}</p>
            <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('マジに削除？');">このコメントを削除する</button>
            </form>
        @endforeach
    </div>

    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#commentForm').submit(function(e) {
            e.preventDefault(); // デフォルトのフォーム送信を停止

            if (confirm('マジコメントしちゃう？')) {
                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('comments.store') }}',
                    data: formData,
                    success: function(response) {
                        $('#content').val('');
                        $('#contentError').empty();

                        var newCommentHtml = '<div>' +
                                            '<p>' + response.comment.content + '</p>' +
                                            '<form method="POST" action="' + '{{ route('comments.destroy', 'id') }}'.replace('id', response.comment.id) + '">' +
                                            '@csrf' +
                                            '<input type="hidden" name="_method" value="DELETE">' +
                                            '<button type="submit" onclick="return confirm(\'マジに削除？\');">このコメントを削除する</button>' +
                                            '</form>' +
                                        '</div>';
                        $('#commentsList').prepend(newCommentHtml);
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        $('#contentError').text(errors.content && errors.content[0]);
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
