<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaravelNews</title>
</head>
<body>
    <h1><a href="{{ route('posts.index') }}">Laravel News</a></h1>
    <h2>ニュース詳細</h2>
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->message }}</p>
    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('マジに削除？');">削除する</button>
    </form>
    <br>
    <h2>コメント投稿</h2>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <textarea name="content"></textarea>
        <br>
        @error('content')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>
        <button type="submit" onclick="confirm('マジコメントしちゃう？')">コメントする</button>
    </form>
    <h2>コメント一覧</h2>
    @foreach ($post->comments as $comment)
        <div>{{ $comment->content }}</div>
        <br>
    @endforeach
</body>
</html>
