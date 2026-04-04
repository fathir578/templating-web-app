@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>

    <form action="/posts/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}">
        </div>
        <div class="form-group">
            <label>Isi</label>
            <textarea name="body" class="form-control">{{ $post->body }}</textarea>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
@endsection