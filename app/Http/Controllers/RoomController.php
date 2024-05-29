<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Comment;
use App\Models\Challenge;
use App\Models\User;
use App\Models\Room_user;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function index(){
        $rooms = Room::all();
        $my_rooms = Room_user::where('user_id',\Auth::user()->id)->get();
        return view('room',compact('rooms','my_rooms'));
    }
    //chalengeをチェック
    public function check(Request $request){
        //24時間以内のis_challenge=challengeのコメントを取得
        $validated = $request->validate([
            'room_id' => 'required'
        ]);
        $room_id = $validated['room_id'];
        $today=Carbon::now()->subHours(24);
        $challenges = Comment::where('room_id',$validated['room_id'])->where('is_challenge','challenge')->where('created_at','>=',$today)->get();
        
        foreach($challenges as $challenge){
                Challenge::create([
                    'challenge_date' => Carbon::yesterday(),
                    'content' => $challenge['content'],
                    'user_id' => $challenge['user_id'],
                    'room_id' => $challenge['room_id'],
                    'path' => $challenge['path'],
                ]);
            
        }

        $challengesLog = Challenge::where('room_id', $room_id)->get();



        //DBからcommets取得
        $comments = Comment::where('room_id',$room_id)->get();
        $comment_user = Comment::where('room_id',$room_id)->pluck('user_id')->toArray();
        $user_names = User::whereIn('id',$comment_user)->get();
        return view('log',compact('user_names','challengesLog','room_id'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'user_id' => 'required',
            'room_id' => 'required',
        ]);
        Room_user::create([
            'user_id' => $validated['user_id'],
            'room_id' => $validated['room_id'],
        ]);
        return to_route('my_room');
    }

    public function delete($room_id){
        Room_user::where('user_id',\Auth::user()->id)->where('room_id', $room_id)->delete();
        return to_route('my_room');
    }
}
