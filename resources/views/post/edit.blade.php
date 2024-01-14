@extends('layouts.app')
@section('title', 'Edit Post')

@section('content')
<form method="post" action="{{ route('update.post', $post->id) }}" class="w-50 mx-auto text-center mt-5"
    enctype="multipart/form-data">
    <!-- cross side requst forgery (helps to stop hackers) -->
    @csrf
    <h4>Edit Post</h4>
    <div>
        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $post->title }}"
                id="title" name="title" placeholder="Enter Post Title">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Post Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                name="description">{{ $post->description }}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>

        <div>
            <img src="{{ asset('posts/'.$post->image) }}" width="200" height="200" alt="">
        </div>
        <label for="image" class="form-label">Post Image</label>
        <div class="input-group mb-3">
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <input type="submit" value="Update Post" class="form-control bg-danger text-light">
    </div>
</form>
@endsection