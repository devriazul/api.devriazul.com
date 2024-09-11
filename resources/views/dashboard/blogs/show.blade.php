<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Blog Details') }}
            </h2>
            <a href="{{ route('dashboard.blogs.edit', $blog->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Edit Blog
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold">{{ $blog->title }}</h1>
                @if ($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-auto my-4">
                @endif
                <p class="mt-4">{{ $blog->content }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
