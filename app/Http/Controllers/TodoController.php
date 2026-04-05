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
        Todo::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
        ]);
        return redirect('/todos');
    }

    public function toggle($id)
    {
        $todo = Todo::find($id);
        $todo->update(['is_done' => !$todo->is_done]);
        return redirect('/todos');
    }

    public function destroy($id)
    {
        Todo::find($id)->delete();
        return redirect('/todos');
    }
}