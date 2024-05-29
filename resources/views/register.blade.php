@extends('layouts.index')
@section('title','会員登録')
@section('content')
<div class="login_form login_card">
  <form action="{{ route('store') }}" method="post">
    @csrf
    <div class="login_input">
    <input class="login_input" type="text" name="name" placeholder="ユーザー名">
    @if($errors->has('name'))
    <br><span>ユーザー名を入力してください</span>
    @endif
    <input class="login_input" type="text" name="email" placeholder="メールアドレス">
    @if($errors->has('email'))
      <br><span>このメールアドレスはすでに使用されています</span>
    @endif
    <input class="login_input" type="text" name="password" placeholder="パスワード">
    @if($errors->has('password'))
    <br><span>パスワードを入力してください</span>
    @endif
    </div>
    <button class="btn" type="submit">登録</button>
  </form>
</div>
@endsection