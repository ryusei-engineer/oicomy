@extends('layouts.index')
@section('title','myroom')
@section('content')
<div class="container">
<h2>マイルーム一覧</h2>
  @foreach($rooms as $room)
    <div class="room_card">
      <div>
        <h2>{{ $room->name }}</h2>
      <form action="{{ route('rooms.delete',['room_id' => $room->id]) }}" method="post">
        @csrf
        @method('delete')
      <button class="btn">登録解除</button>
      </div>
      
      </form>
      <p>{{ $room->description }}</p>
      <div class="cardFooter">
        <a class="btn" href="{{ route('chat',['room_id' => $room->id]) }}">チャット画面へ</a>
        <div class="span">
          <span>{{ $room->term }}日間</span>
          <span>{{ $room->value }}円</span>
        </div>
        
      </div>
    </div>
  @endforeach
</div>
    <a href="{{ route('rooms') }}">ルームを探す</a>
@endsection