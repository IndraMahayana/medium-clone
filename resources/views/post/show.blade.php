<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <h1 class="text-5xl mb-4">{{ $post->title }}</h1>
                    <div class="flex gap-4">
                        @if ($post->user->image)
                            <img class="w-16 h-16 rounded-full" src="{{ $post->user->imageUrl() }}"
                                alt="{{ $post->user->name }}">
                        @else
                            <img class="w-16 h-16 rounded-full" src="{{ asset('images/default-avatar.png') }}"
                                alt="Default Avatar">
                        @endif
                        {{-- user section --}}
                        <div>
                            <div class="flex gap-2">
                                <h3>{{ $post->user->name }}</h3>
                                <a href="#" class="text-emerald-500">Follow</a>
                            </div>
                            <div class="flex gap-3 text-gray-500 text-sm">
                                {{ $post->readTime() }}
                                &middot;
                                {{ $post->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                    {{-- clap section --}}
                    <x-clap-button clapCount="4.4k"></x-clap-button>

                    {{-- content section --}}
                    <div class="mt-8">
                        <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                            class="w-full h-64 object-cover rounded-lg mb-4">
                        <div>
                            <p class="text-gray-700 dark:text-gray-400">{{ $post->content }}</p>
                        </div>
                    </div>

                    {{-- category section --}}
                    <div class="mt-8">
                        <x-primary-button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            {{ $post->category ? $post->category->name : 'No Category' }}    
                        </x-primary-button>
                    </div>

                    {{-- clap section --}}
                    <x-clap-button clapCount="4.4k"></x-clap-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
