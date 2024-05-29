@extends('layouts.index')
@section('title','ログイン')
@section('content')
<div class="login_form login_card">
  <form action="{{ route('login') }}" method="post">
    @csrf
    <div class="login_input">
    <input type="text" name="email" placeholder="メールアドレス">
    <input type="text" name="password" placeholder="パスワード">
    @if(session('error'))
      <span>{{ session('error') }}</span>
    @endif
    </div>
    <button type="submit" class="btn">ログイン</button>
  </form>
</div>
@endsection