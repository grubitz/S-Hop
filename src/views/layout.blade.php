<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>S-hop</title>
    @yield('meta')
    <link href="/assets/style.css" rel="stylesheet">
  </head>
  <body>
      @if (isset($selectedCategoryAncestry))
        {{ Grubitz\ViewHelper::printTree($categoryTree, $selectedCategoryAncestry) }}
      @else
        {{ Grubitz\ViewHelper::printTree($categoryTree) }}
      @endif
    @yield('content')
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <script src="/assets/index.js"></script>
  </body>
</html>
