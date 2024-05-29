@extends('layouts.index')
@section('title','Oicomy')
@section('content')

<div class="login_card">
  <div class="login_btn">
    <a href="{{ route('login') }}">ログイン</a>
    <a href="{{ route('register') }}">会員登録</a>
  </div>
</div>
@endsection