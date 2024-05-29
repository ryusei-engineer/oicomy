@extends('layouts.index')
@section('title','チャット画面')
@section('content')
<h2 class="room_name">{{ $room_name->name }}</h2>
@if(\Auth::user()->email == 'admin')
<form action="{{ route('log',['room_id' => $room_id]) }}" method="get">
  <input type="hidden" name="room_id" value="{{ $room_id }}">
  <button>管理者用</button>
</form>
@endif
<div class="chat_container">
  @if(isset($comments))
    @foreach($comments as $comment)
    <!-- 他のユーザーのコメント表示 -->
      @if($comment->user_id != \Auth::user()->id)
      @if($comment->is_challenge != 'challenge')
        <div class="others_chat">
        @foreach($user_names as $user_name)
          @if($comment->user_id === $user_name->id)
            <p class="user_name">{{ $user_name->name }}</p>
          @endif
        @endforeach
        <p class="chat_content">{{ $comment->content }}</p>
        @if($comment->path)
          <img src="{{ Storage::url($comment->path) }}" alt="">
        @endif
        </div>
        @endif

        <!-- challengeコメントの場合 -->
        @if($comment->is_challenge == 'challenge')
          <div class="others_chat">
            @foreach($user_names as $user_name)
              @if($comment->user_id === $user_name->id)
                <p class="user_name">{{ $user_name->name }}</p>
              @endif
            @endforeach
            <p class="chat_content challenge_comment">{{ $comment->content }}</p>
              @if($comment->path)
                <img class="challenge_comment" src="{{ Storage::url($comment->path) }}" alt="">
              @endif
          </div>
          @endif
        @endif

        <!-- ログイン中ユーザーのコメント表示 -->
      @if($comment->user_id == \Auth::user()->id)
      @if($comment->is_challenge != 'challenge')
        <div class="my_chat">
        <p class="chat_content">{{ $comment->content }}</p>
        @if($comment->path)
          <img src="{{ Storage::url($comment->path) }}" alt="">
        @endif
        </div>
        @endif

        @if($comment->is_challenge == 'challenge')
        <div class="my_chat">
        
        <p class="chat_content challenge_comment">{{ $comment->content }}</p>
        @if($comment->path)
          <img class=" challenge_comment" src="{{ Storage::url($comment->path) }}" alt="">
        @endif
        </div>
        @endif
      @endif

      
    @endforeach
  @endif
  


@if(isset($challenges))
@foreach($challenges as $challenge)
<h2>{{ $challenge->content }}</h2>
<h3>{{ $challenge->user_id }}</h3>
  @foreach($user_names as $user_name)
    @if($challenge->user_id === $user_name->id)
    <p>{{ $user_name->name }}</p>
    <span>________________</span>
    @endif
  @endforeach
@endforeach
@endif
</div>

<form class="chat_input" action="{{route('chat.store',['room_id' => $room_id])}}" method="post" enctype="multipart/form-data">
@if($today_04_challenge->isNotEmpty())
  <p class="challenged">本日のチャレンジは投稿済みです</p>
@endif
  @csrf
  <div class="form_container">


  <label class="chat_img">+<input type="file" name="image"></label>
  <input type="text" name="content" placeholder="コメントを入力">
  <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}">
  <input type="hidden" name="room_id" value="{{ $room_id }}">
  


  @if($today_04_challenge->isEmpty())
  <label class="is_challenge"><input type="checkbox" name="is_challenge" value="challenge">チャレンジ</label>
  @endif

  <button type="submit">送信</button>
  </div>
</form>


<!-- <div>
  <form action="{{ route('log',['room_id' => $room_id]) }}" method="get">
  <input type="hidden" name="room_id" value="{{ $room_id }}">
  <button>check</button>
</form>
</div> -->




@endsection