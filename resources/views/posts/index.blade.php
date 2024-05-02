<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaravelNews</title>
</head>
<body>
    <h1><a href="{{ route('posts.index') }}">Laravel News</a></h1>
    <h2>ニュース投稿</h2>
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <label for="title">タイトル:</label>
        <input type="text" name="title" id="title">
        <br>
        @error('title')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>
        <label for="message">投稿内容:</label>
        <textarea name="message" id="message"></textarea>
        <br>
        @error('message')
            <div style="color: red;">{{ $message }}</div>
        @enderror
        <br>
        <button type="submit" onclick="confirm('マジ投稿しちゃう？')">投稿する</button>
    </form>
    <br>
    <h2>ニュース一覧</h2>
    @foreach ($posts as $post)
        <h3><a href="{{ route('posts.show', $post->id) }}">タイトル：{{ $post->title }}</a></h3>
        <p>内容：{{ $post->message }}</p>
        <br>
    @endforeach
</body>
</html>
