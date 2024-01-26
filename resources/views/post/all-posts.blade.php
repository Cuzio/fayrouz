@extends('layouts.app')
@section('title', 'All Posts')

@section('content')

@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session()->get('error')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session()->get('success')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<h1 class="text-center">All Posts</h1>

@foreach ($posts as $post)
<a href="{{ route('single.post', $post->id) }}" class="text-dark text-decoration-none">
    <div class="w-50 mx-auto my-5 all-posts-container p-3">
        <img src="{{ asset('posts/'.$post->image) }}" alt="" class="image">
        <h3>Title: {{ $post->title }}</h3>
    </div>
</a>
@endforeach

@endsection