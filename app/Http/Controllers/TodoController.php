<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', auth()->id())->get();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        // Validasi input sebelum disimpan
        // 'title' => 'required' artinya title wajib diisi
        // 'min:3' artinya minimal 3 karakter
        // 'max:100' artinya maksimal 100 karakter
        $request->validate([
            'title' => 'required|min:3|max:100',
        ]);

        // Kalau validasi lolos, baru simpan ke database
        Todo::create([
            'user_id' => auth()->id(), // ambil id user yang sedang login
            'title' => $request->title, // ambil title dari form
        ]);

        return redirect('/todos');
    }

    public function destroy($id)
    {
        Todo::find($id)->delete();
        return redirect('/todos');
    }
}
