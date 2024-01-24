@extends('layouts.app')
@section('title', 'Single Posts')

@section('content')
<h1>Single Posts</h1>

<div class="w-50 mx-auto my-5 all-posts-container p-3">
    <img src="{{ asset('posts/'.$singlePost->image) }}" alt="" class="image">
    <h3>Title: {{ $singlePost->title }}</h3>
    <h3>Description: {{ $singlePost->description }}</h3>
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
</div>

<script>
const check = () => {
    const check = confirm('Are you sure you want to delete this post?');
    return check;
}
</script>

@endsection