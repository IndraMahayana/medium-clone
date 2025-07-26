@props(['user'])

<div x-data="{
    following: {{ $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
    followersCount: {{ $user->followers()->count() }},
    follow() {
        this.following = !this.following
        axios.post('/follow/{{ $user->id }}').then(response => {
            // Handle success response
            if (this.following) {
                // User is now following
                this.followersCount = response.data.followersCount
                console.log('Followed successfully');

            } else {
                // User has unfollowed
                console.log('Unfollowed successfully');
            }
        }).catch(error => {
            // Handle error response
            console.error('Error following/unfollowing:', error);
        });
    }
}" class="w-[320px] border-l">
{{ $slot }}
</div>
