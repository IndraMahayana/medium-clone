@props(['user'])

@if ($user->image)
    <img class="w-16 h-16 rounded-full" src="{{ $user->imageUrl() }}" alt="{{ $user->name }}">
@else
    <img class="w-16 h-16 rounded-full" src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar">
@endif
