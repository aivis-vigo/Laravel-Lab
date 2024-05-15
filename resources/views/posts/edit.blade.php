<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $post->title }}" required>
        </div>
        <div>
            <label for="body">Body:</label>
            <textarea id="body" name="body" required cols="80" rows="20">{{ $post->body }}</textarea>
        </div>
        <select name="author_id" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ (isset($post) && $post->author_id == $user->id) ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        <div>
            <label for="category">Category:</label>
            <select id="category" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
</body>
</html>
