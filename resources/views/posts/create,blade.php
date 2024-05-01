<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>
    <h1>Create New Post</h1>
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="message">Message:</label>
        <textarea name="message" id="message" required></textarea>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
