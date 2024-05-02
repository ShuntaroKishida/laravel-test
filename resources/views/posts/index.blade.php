<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaravelNews</title>
    <link rel="stylesheet" href="https://unpkg.com/destyle.css@1.0.5/destyle.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="main_title">
        <h1><a href="{{ route('posts.index') }}">Laravel News</a></h1>
    </div>
    <h2>ニュース投稿</h2>
    <form method="POST" action="{{ route('posts.store') }}">
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
        <button type="submit" onclick="confirm('マジ投稿しちゃう？')">投稿する</button>
    </form>
    <h2>ニュース一覧</h2>
    @foreach ($posts as $post)
        <h3><a href="{{ route('posts.show', $post->id) }}">タイトル：{{ $post->title }}</a></h3>
        <p>内容：{{ $post->message }}</p>
    @endforeach
</body>
</html>
