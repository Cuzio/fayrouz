@extends('layouts.app')
@section('title', 'All Posts')

@section('content')
<h1>All Posts</h1>

@foreach ($posts as $post)
<h3>{{ $post->title }}</h3>
<h3>{{ $post->description }}</h3>
<img src="{{ asset('posts/'.$post->image) }}" alt="">
@endforeach

@endsection