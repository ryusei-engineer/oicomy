@extends('layouts.index')
@section('title','room一覧')
@section('content')
<div class="container">
  <h2>ルーム一覧</h2>
  @foreach($rooms as $room)
      <div class="room_card">
        <h2>{{ $room->name }}</h2>
        <p>{{ $room->description }}</p>
        <div class="cardFooter">
          <form action="{{ route('rooms.store') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}">
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <button class="register_btn" type="submit">登録する</button>
          </form>
          <div class="span">
            <span>{{ $room->term }}日間</span>
            <span>{{ $room->value }}円</span>
          </div>

        </div>
      </div>
    @endforeach
      <button class="btn" type="button" onClick="history.back()">戻る</button>
    </div>
@endsection