<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Challenge;
use  App\Models\Room;
use Carbon\Carbon;

class TopController extends Controller
{
    public function index(){
        return view('/index');
    }

    public function register(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function my_room(){
        return view('my_room');
    }
    

    public function chat($room_id){
        $comments = Comment::where('room_id',$room_id)->get();
        $room_name = Room::where('id',$room_id)->first();
        $comment_user = Comment::where('room_id',$room_id)->pluck('user_id')->toArray();
        $user_names = User::whereIn('id',$comment_user)->get();

        //今日の4:00以降のchallengeを取得（一日に二回チャレンジを投稿）
        //今日の投稿があるかないかを判断
        //修正済
        $today_04 = Carbon::today()->setHours(4);
        $today_04_challenge= Comment::where('room_id',$room_id)->where('is_challenge','challenge')->where('user_id', \Auth::user()->id)->where('created_at','>=',$today_04)->get();

        // dd($today_04_challenge);
        return view('chat',compact('comments','user_names','room_id','today_04_challenge','room_name'));
    }

    public function log($room_id){
        $comments = Comment::where('room_id',$room_id)->get();
        $comment_user = Comment::where('room_id',$room_id)->pluck('user_id')->toArray();
        $user_names = User::whereIn('id',$comment_user)->get();
        $challengesLog = Challenge::all();
        return view('log', compact('room_id','user_names','challengesLog'));
    }
    
}
