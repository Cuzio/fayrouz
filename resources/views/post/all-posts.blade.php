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

{{-- forelse is just like foreach, saying that if there is this, do this. else do this --}}
@forelse ($posts as $post)
<a href="{{ route('single.post', $post->id) }}" class="text-dark text-decoration-none">
    <div>
        <p><span style="font-style: italic">Posted by: </span>{{ $post->user->first_name }} {{ $post->user->last_name }}</p>
    </div>
    <div class="w-50 mx-auto my-5 all-posts-container p-3">
        <img src="{{ asset('posts/'.$post->image) }}" alt="" class="image">
        <hr>
        <h3>Title: {{ $post->title }}</h3>
        <hr>

        <div class="d-flex justify-content-between">
            <p>{{ $post->comments->count() }} <span>Comments</span></p>
            <p>Date posted <span style="font-style: italic">{{ $post->created_at->format('d:M:Y') }}</span></p>
        </div>

    </div>
</a>

{{-- @empty stands as the else statment here. --}}
@empty
<div class="text-center text-danger">No Posts yet...</div>
@endforelse


{{-- for pagination --}}
<div class="d-flex justify-content-center mt-3" style="margin-bottom: 20%">
    {{ $posts->links() }}
</div>

@endsection
