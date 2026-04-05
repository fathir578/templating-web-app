@extends('layouts.app')

@section('content')
    <h1>Daftar Post</h1>
@foreach($posts as $post)
    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $post->title }}</h5>
            <p>{{ $post->body }}</p>
            <a href="/posts/{{ $post->id }}/edit" class="btn btn-warning btn-sm">Edit</a>

            <form action="/posts/{{ $post->id }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    </div>
@endforeach
@endsection