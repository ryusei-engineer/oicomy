<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Comment;
use  App\Models\Challenge;

class ChatController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'is_challenge' => 'nullable',
            'content' => 'required',
            'user_id' => 'required',
            'room_id' => 'required',
            'path' => 'nullable'
        ]);
        $is_challenge = isset($validated['is_challenge']) ? $validated['is_challenge'] : null;
        if($request->hasFile('image')){
            $path = $request->file('image')->store('public/images');
        }else{
            $path = null;
        }
        Comment::create([
            'is_challenge' => $is_challenge,
            'content' => $validated['content'],
            'user_id' => $validated['user_id'],
            'room_id' => $validated['room_id'],
            'path' => $path,
        ]);

        

        return back();
    }
}
