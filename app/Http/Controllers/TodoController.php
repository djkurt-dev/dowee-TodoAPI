<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        return response()->json(['data'=>$todos],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'=>'required|string',
            'details'=>'required|max:255',
            'done'=>'required|boolean'
            ]);

        $todo = Todo::create($validated);
        return response()->json(['data'=>$todo],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $todo = Todo::find($id);
        if(!$todo) {
            return response()->json(['message'=>"Todo does not exist"],404);
        }
        return response()->json(['data'=>$todo],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $validated = $request->validate([
            'title'=>'sometimes|string',
            'details'=>'sometimes|max:255',
            'done'=>'sometimes|boolean'
            ]);
        
        $todo = Todo::find($id);
        if(!$todo) {
            return response()->json(['message'=>"Todo does not exist"],404);
        }
        $todo->update($validated);
        
        return response()->json(['data'=>$todo],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::find($id);
        if(!$todo) {
            return response()->json(['message'=>"Todo does not exist"],404);
        }
        $todo->delete();
        return response()->json(null,204);
    }
}
