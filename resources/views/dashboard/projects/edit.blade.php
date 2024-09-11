<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('dashboard.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Title') }}</label>
                        <input type="text" name="title" class="w-full p-2 mt-2 border rounded-md" value="{{ $project->title }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Description') }}</label>
                        <textarea name="content" class="w-full p-2 mt-2 border rounded-md" rows="5" required>{{ $project->content }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Slug') }}</label>
                        <input type="text" name="slug" class="w-full p-2 mt-2 border rounded-md" value="{{ $project->slug }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Image') }}</label>
                        @if ($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-auto h-32 my-4">
                        @endif
                        <input type="file" name="image" class="w-full p-2 mt-2 border rounded-md">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">{{ __('Update Project') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
