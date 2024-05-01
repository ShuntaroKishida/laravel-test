<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1><a href="{{ route('posts.index') }}">Laravel News</a></h1> {{-- index.blade.phpへのリンク --}}
    <br>
    @foreach ($posts as $post) {{-- PostControllerのindexメソッド内の「$posts」を受け取る --}}
        <h3>タイトル：{{ $post->title }}</h3>
        <p>内容：{{ $post->message }}</p>
        <br>
    @endforeach
</body>
</html>
