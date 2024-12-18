<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" value="{{ old('subject', $post->title) }}" required>
        </div>
        <div>
            <label for="Content">Content</label>
            <textarea name="Content" id="Content" required>{{ old('Content', $post->content) }}</textarea>
        </div>
        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>
        <div>
            <button type="submit">Update</button>
        </div>
    </form>
</body>
</html>
