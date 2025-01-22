<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Default Title')</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/00_common.css') }}" />
  @yield('css')
</head>

<body>
    <header class="header">
        <h1 class="logo">mogitate</h1>
    </header>

  <main>
    @yield('content')
  </main>

  @yield('scripts') <!-- 各ページごとにスクリプトを追加 -->
</body>
</html>
