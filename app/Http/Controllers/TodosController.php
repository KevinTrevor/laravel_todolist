<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodosController extends Controller
{
    /** 
     * index para mostrar
     * store para guardar
     * update para actualizar
     * destroy para eliminar
     * edit para mostrar formulario de edición
    */

    public function store(Request $request) {
        
        $request->validate([
            'title' => 'required|min:5'
        ]);

        $todo = new Todo;
        $todo->title = $request->title;
        $todo->save();

        return redirect()->route('todos')->with('success', 'Todo created successfully.');
    }

    public function index() {
        $todos = Todo::all();

        return view('todos.index', ['todos' => $todos]);
    }

    public function show($id) {
        $todo = Todo::find($id);

        return view('todos.show', ['todo' => $todo]);
    }

    public function update(Request $request, $id) {
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->save();

        return redirect()->route('todos')->with('success', 'Todo updated successfully.');
    }

    public function destroy($id) {
        $todo = Todo::find($id);
        $todo->delete();

        return redirect()->route('todos')->with('success', 'Todo deleted successfully.');
    }
}
