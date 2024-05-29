<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\TopController;
use  App\Http\Controllers\AuthController;
use App\Http\Controllers\MyRoomController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ChatController;




//各ページ遷移
Route::get('/',[TopController::class,'index'])->name('index');
Route::get('/register',[TopController::class,'register'])->name('register');
Route::get('/login',[TopController::class,'login'])->name('login')->middleware('web');

// groupでまとめたルーティング
// Route::get('/my_room',[MyRoomController::class,'my_room'])->name('my_room');
// Route::get('/rooms',[RoomController::class,'index'])->name('rooms');
// Route::get('/chat/{room_id}',[TopController::class,'chat'])->name('chat');
// Route::get('/log/{room_id}',[TopController::class,'log'])->name('log');
Route::group(['middleware' => 'auth'], function () {
  Route::get('/my_room',[MyRoomController::class,'my_room'])->name('my_room');
  Route::get('/rooms',[RoomController::class,'index'])->name('rooms');
  Route::get('/chat/{room_id}',[TopController::class,'chat'])->name('chat');
  Route::get('/log/{room_id}',[TopController::class,'log'])->name('log');
});


//会員登録処理
Route::post('/register/store', [AuthController::class,'store'])->name('store');
Route::post('/login', [AuthController::class,'login'])->middleware('web');

//コメント投稿処理
Route::post('/chat', [ChatController::class,'store'])->name('chat.store')->middleware('web');
//チャレンジ投稿処理
Route::post('/chat/challenge', [ChatController::class,'challenge'])->name('challenge')->middleware('web');

Route::post('/chat/check', [RoomController::class,'check'])->name('check')->middleware('web');

//room参加処理
Route::post('/rooms', [RoomController::class,'store'])->name('rooms.store')->middleware('web');

//room削除処理
Route::delete('/rooms/{room_id}', [RoomController::class,'delete'])->name('rooms.delete')->middleware('web');

Route::post('/logout', [AuthController::class,'logout'])->name('logout')->middleware('web');
