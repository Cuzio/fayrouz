@extends('layouts.app')
@section('title', 'All Posts')

@section('content')
<h1>All Posts</h1>

@foreach ($posts as $post)
<a href="{{ route('single.post', $post->id) }}" class="text-dark text-decoration-none">
    <div class="w-50 mx-auto my-5 all-posts-container p-3">
        <img src="{{ asset('posts/'.$post->image) }}" alt="" class="image">
        <h3>Title: {{ $post->title }}</h3>
    </div>
</a>
@endforeach

@endsection