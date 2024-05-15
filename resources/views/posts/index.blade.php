<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog page</title>
</head>
<body>
    <h1>Welcome to the programming blog</h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>

    @auth
        <a href="{{ route('posts.create') }}">
            Create new blog post
        </a>
    @endauth
    
    @foreach ($posts as $post)
        
        <h2>
            <a href="{{ route('posts.show', $post->id) }}">
                {{ $post->title }}
            </a>
        </h2
        <p>
            An article by <em>{{$post->author->name}}</em> published on {{$post->created_at}}
        </p>
        <p>{{ $post->body }}</p>

        @can('update-post', $post)
            <form method="GET" action="{{ route('posts.edit', $post->id) }}">
                @csrf
                <button type="submit">Edit post</button>
            </form>

            <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Delete post</button>
            </form>
        @endcan

    @endforeach

</body>
</html>