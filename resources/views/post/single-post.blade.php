@extends('layouts.app')
@section('title', 'Single Posts')

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

<h1 class="text-center">Single Posts</h1>

<div class="w-50 mx-auto my-5 all-posts-container ps-3 pe-1 py-3">
    <img src="{{ asset('posts/'.$singlePost->image) }}" alt="" class="image">
    <h3>Title: {{ $singlePost->title }}</h3>
    <h3>Description: {{ $singlePost->description }}</h3>
    {{-- for the edit and delete buttons to be shown to only the user that created it and is logged in, use the next line --}}
    <div class="d-flex">
    @if (auth()->check() && $singlePost->user_id == auth()->id())
    <div class="d-flex">
        <div class="me-3">
            <a href="{{ route('edit.post', $singlePost->id) }}"><button class="btn btn-primary">Edit</button></a>
        </div>
        <form action="{{ route('delete.post', $singlePost->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" onclick="return check()">Delete</button>
        </form>
    </div>
    @endif
    <i class="fa-regular fa-comment" onclick="showForm()"></i>
</div>
</div>

    {{-- for the comment to be added and seen by only users that are logged in, use the next line --}}
    @if (auth()->check())
    <div class="my-3 text-center">
        <div class="comment-form" id="commentForm">
        <h4>Comment</h4>

        <form action="{{ route('comment', $singlePost->id) }}" method="post" class="w-50 mx-auto">
            @csrf
            <div class="mb-3">
                <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" rows="3"
                    name="comment"></textarea>
                @error('comment')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <input type="submit" value="comment" class="form-control bg-danger text-light">
        </form>
    </div>

        <div class="mt-3">
            <h4 style="font-style: italic">Comments</h4>
            @foreach ($comments as $comment )
                <div>
                    {{ $comment->comment }}
                </div>
            @endforeach
        </div>
        @endif
    </div>

<script>
const check = () => {
    const check = confirm('Are you sure you want to delete this post?');
    return check;
}

function showForm() {
   document.getElementById('commentForm').style.display = "block";
}
</script>

@endsection
