<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Categoires:
                </h2>
                @foreach($categories as $category)
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ $category->id }}. {{ $category->title }}
                </div>
                @endforeach
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Posts:
                </h2>
                @foreach($posts as $post)
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ $post->id }}. {{ $post->title }}
                </div>
                @endforeach
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Comments:
                </h2>
                @foreach($comments as $comment)
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ $comment->id }}. '{{ $comment->body }}' - {{ $comment->author}} 
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
