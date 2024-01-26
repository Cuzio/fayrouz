@extends('layouts.app')
@section('title', 'Create Post')

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

<form method="post" action="/create-post" class="w-50 mx-auto text-center mt-5" enctype="multipart/form-data">
    <!-- cross side requst forgery (helps to stop hackers) -->
    @csrf
    <h4>Create Post</h4>
    <div>
        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                placeholder="Enter Post Title">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Post Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="3"
                name="description"></textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
            </span>
            @enderror
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
        <input type="submit" value="Post" class="form-control bg-danger text-light">
    </div>
</form>
@endsection