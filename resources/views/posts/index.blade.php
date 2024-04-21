<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog page</title>
</head>
<body>
    <h1>Welcome to the programming blog</h1>

    <a href="{{ route('posts.create') }}">
        Create new blog post
    </a>
    
    @foreach ($posts as $post)
        
        <h2>
            <a href="{{ route('posts.show', $post->id) }}">
                {{ $post->title }}
            </a>
        </h2
        <p>
            An article by <em>{{$post->author}}</em> published on {{$post->created_at}}
        </p>
        <p>{{ $post->body }}</p>

        <form method="GET" action="{{ route('posts.edit', $post->id) }}">
            @csrf
            <button type="submit">Edit post</button>
        </form>

        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete post</button>
        </form>

    @endforeach

</body>
</html>