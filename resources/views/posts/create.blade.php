@extends('layouts.app')

@section('content')
    <h1>Tambah Post</h1>

    <form action="/posts" method="POST">
        @csrf
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Isi</label>
            <textarea name="body" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection