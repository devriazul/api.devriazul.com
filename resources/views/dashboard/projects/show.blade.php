<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Project Details') }}
            </h2>
            <a href="{{ route('dashboard.projects.edit', $project->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Edit Project
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold">{{ $project->title }}</h1>

                @if ($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-auto my-4">
                @endif

                <p class="mt-4">{{ $project->description }}</p>

                <div class="mt-6">
                    <h2 class="text-lg font-semibold">{{ __('Technologies Used') }}</h2>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($project->technologies as $technology)
                            <li>{{ $technology }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-6">
                    <h2 class="text-lg font-semibold">{{ __('Project Link') }}</h2>
                    <a href="{{ $project->link }}" target="_blank" class="text-blue-500 hover:underline">
                        {{ $project->link }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
