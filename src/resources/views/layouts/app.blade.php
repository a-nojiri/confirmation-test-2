<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'もぎたて')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{
      font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Noto Sans JP', Arial, sans-serif;
      max-width: 960px; margin: 24px auto; padding: 0 16px; line-height: 1.6;
    }
    header{display:flex;justify-content:space-between;align-items:center;margin:8px 0 16px}
    .right{text-align:right}
    .btn{display:inline-block;padding:8px 12px;border:1px solid #ccc;border-radius:6px;text-decoration:none}
    .btn-primary{background:#f7c623;border-color:#f7c623}
    .card{border:1px solid #eee;border-radius:8px;padding:12px;margin:8px 0}
    .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px}
    img{max-width:100%;height:auto;border-radius:6px}
    form .row{margin:10px 0}
    .label{display:block;margin-bottom:4px;font-weight:600}
    .actions{display:flex;gap:8px;margin-top:12px}
    .danger{color:#c00}
    .help{color:#666;font-size:12px}
  </style>
</head>
<body>
  <header>
    <div style="font-weight:700;color:#f7c623">mogitate</div>
    <div class="right">@yield('header-right')</div>
  </header>

  @yield('content')
</body>
</html>
