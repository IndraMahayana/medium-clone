<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex">
                    <div class="flex-1">
                        <h1 class="text-5xl">{{ $user->name }}</h1>
                        <div>
                            @forelse ($posts as $post)
                                <x-post-item :post="$post"></x-post-item>
                            @empty
                                <div>
                                    <p class="text-gray-500">No posts available.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <x-follow-ctr :user="$user">
                        <x-user-avatar :user="$user"></x-user-avatar>
                        <h3>{{ $user->name }}</h3>
                        <p class="text-gray-500">
                            <span x-text="followersCount"></span> Followers</p>
                        <p>
                            {{ $user->bio ?? 'This user has not set a bio yet.' }}
                        </p>
                        @if (auth()->user() && auth()->user()->id !== $user->id)
                            <div>
                                <button
                                @click="follow()"
                                class="mt-4 px-4 py-2 text-white rounded-lg"
                                x-text="following ? 'Unfollow' : 'Follow'"
                                :class="following ? 'bg-red-500 hover:bg-red-600' : 'bg-blue-500 hover:bg-blue-600'"
                                >
                                    {{-- @if (auth()->user()->isFollowing($user))
                                        Unfollow
                                    @else
                                        Follow
                                    @endif --}}
                                    
                                </button>
                            </div>
                        @endif
                    </x-follow-ctr>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
