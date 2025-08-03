<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <h1 class="text-5xl mb-4">{{ $post->title }}</h1>
                    <div class="flex gap-4">
                        <x-user-avatar :user="$post->user">

                        </x-user-avatar>
                        {{-- user section --}}
                        <div>
                            <x-follow-ctr :user="$post->user" class="flex gap-2">
                                <a href="{{ route('profile.show', $post->user) }}">{{ $post->user->name }}</a>
                                @auth
                                    &middot;
                                    <button @click="follow()" x-text="following ? 'Unfollow' : 'Follow'"
                                        :class="following ? 'bg-red-500 hover:bg-red-600' : 'bg-blue-500 hover:bg-blue-600'"></button>
                                @endauth
                            </x-follow-ctr>
                            <div class="flex gap-3 text-gray-500 text-sm">
                                {{ $post->readTime() }}
                                &middot;
                                {{ $post->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>

                    {{-- delete edit --}}
                    @if ($post->user_id === Auth::id())
                        <div class="mt-4">
                            <a href="{{ route('post.edit', $post) }}">
                                <x-primary-button>
                                    Edit Post
                                </x-primary-button>
                            </a>

                            <form class="inline-block" action="{{ route('post.destroy', $post->slug) }}" method="POST">
                                @csrf
                                @method('delete')
                                <x-danger-button>
                                    Delete Post
                                </x-danger-button>
                            </form>
                        </div>
                    @endif

                    {{-- clap section --}}
                    <x-clap-button :post='$post'></x-clap-button>

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
                    <x-clap-button :post="$post"></x-clap-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
