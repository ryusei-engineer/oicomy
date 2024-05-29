<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','Oicomy')</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <header>
    <h1>Oicomy</h1>

    <div class="hamburger">
      <span class="material-icons" id="open">menu</span>
    </div>

    <div class="overlay">
      <div class="hamburger">
        <span class="material-icons hamburgerButton" id="close" >close</span>
      </div>
    
      <ul>
      <li><a href="{{ route('index') }}">TOP</a></li>
      <li><a href="{{ route('my_room') }}">Myroom一覧</a></li>
      <li>
        <a href="{{ route('rooms') }}"><span>Roomを探す</span></a></li>

        <li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button><span>Logout</span></button>
          </form>
        </li>
      
      </ul>
    </div>
  </header>
  <main>
  @yield('content')
  </main>
  <script src="../js/main.js"></script>
</body>
</html>