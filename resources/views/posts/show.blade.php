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
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <textarea name="content"></textarea>
        @error('content')
            <div class="alert">{{ $message }}</div>
        @enderror
        <button type="submit" onclick="confirm('マジコメントしちゃう？')">コメントする</button>
    </form>
    <h2>コメント一覧</h2>
    @foreach ($post->comments as $comment)
        <div>{{ $comment->content }}</div>
        <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('マジに削除？');">このコメントを削除する</button>
        </form>
    @endforeach
</body>
</html>
