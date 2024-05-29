@extends('layouts.index')
@section('title','ログ画面')
@section('content')




@if(isset($challengesLog))
@php
$day = 0;
@endphp
@foreach($challengesLog as $challenge)
  @if($challenge->challenge_date != $day)
    @php
      $day = $challenge->challenge_date;
    @endphp
    <br>
    <p>{{ $challenge->challenge_date }}の結果</p>
  @endif
  @foreach($user_names as $user_name)
    @if($challenge->user_id === $user_name->id)
    <p>{{ $user_name->name }}さん</p>
    @endif
  @endforeach
@endforeach
@endif
<span>________________</span>
@if(\Auth::user()->email === 'admin')
<form action="{{ route('check') }}" method="post">
  @csrf
  <input type="hidden" name="room_id" value="{{ $room_id }}">
  <button>check</button>
</form>
@endif
<button type="button" onClick="history.back()">戻る</button>

@endsection