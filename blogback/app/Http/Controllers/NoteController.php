<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function index(Request $request)
    {
        return Note::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

   
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:100',
        'content' => 'nullable',
        'priority' => 'required'
    ]);

    $note = Note::create([
        'title' => $request->title,
        'content' => $request->content ?? '',
        'priority' => $request->priority,
        'user_id' => $request->user()->id
    ]);

    return response()->json($note, 201);
}

  
    public function update(Request $request, $id)
    {
        $note = Note::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$note) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $note->update($request->all());

        return response()->json($note);
    }

 
    public function destroy(Request $request, $id)
    {
        $note = Note::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$note) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $note->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
