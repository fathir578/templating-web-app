@extends('layouts.app')
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Todo App</h1>
</div>

<!-- Form Tambah Todo -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Todo Baru</h6>
    </div>
    <div class="card-body">
        <form action="/todos" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="title" 
                       class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" 
                       placeholder="Tulis todo kamu..."
                       value="{{ old('title') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
            @if($errors->has('title'))
                <div class="text-danger mt-2">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first('title') }}
                </div>
            @endif
        </form>
    </div>
</div>

<!-- List Todo -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Todo</h6>
    </div>
    <div class="card-body">
        @if($todos->isEmpty())
            <p class="text-center text-muted">Belum ada todo. Tambahkan sekarang!</p>
        @else
            @foreach($todos as $todo)
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="{{ $todo->is_done ? 'text-muted' : '' }}" 
                          style="{{ $todo->is_done ? 'text-decoration: line-through;' : '' }}">
                        <i class="fas {{ $todo->is_done ? 'fa-check-circle text-success' : 'fa-circle text-secondary' }} mr-2"></i>
                        {{ $todo->title }}
                    </span>
                    <div>
                        <a href="/todos/{{ $todo->id }}/toggle" 
                           class="btn btn-sm {{ $todo->is_done ? 'btn-secondary' : 'btn-success' }}">
                            {{ $todo->is_done ? 'Batal' : 'Selesai' }}
                        </a>
                        <form action="/todos/{{ $todo->id }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @if(!$loop->last)
                    <hr>
                @endif
            @endforeach
        @endif
    </div>
</div>

@endsection