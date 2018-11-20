<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>S-hop</title>
    @yield('meta')
    <link href="/style.css" rel="stylesheet">
  </head>
  <body>
    {{ Grubitz\ViewHelper::printTree($categoryTree) }}
    @yield('content')
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <script src="/index.js"></script>
  </body>
</html>
