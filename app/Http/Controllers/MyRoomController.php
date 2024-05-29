<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Room_user;


class MyRoomController extends Controller
{
    public function my_room(){
        $my_rooms = Room_user::where('user_id',\Auth::user()->id)->pluck('room_id')->toArray();
        $rooms = Room::whereIn('id',$my_rooms)->get();
        return view('my_room', compact('rooms'));
    }
}


