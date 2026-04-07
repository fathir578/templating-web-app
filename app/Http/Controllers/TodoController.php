<?php
namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $todos = Todo::where('user_id', auth()->id())
                    ->when($search, function($query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->get();

        return view('todos.index', compact('todos', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:100',
        ]);

        Todo::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
        ]);

        return redirect('/todos');
    }

    // Method toggle - tandai todo selesai atau batal
    public function toggle($id)
    {
        $todo = Todo::find($id);
        // ! artinya kebalikan dari nilai sekarang
        // kalau is_done = true maka jadi false, begitu sebaliknya
        $todo->update(['is_done' => !$todo->is_done]);
        return redirect('/todos');
    }

    public function destroy($id)
    {
        Todo::find($id)->delete();
        return redirect('/todos');
    }
}