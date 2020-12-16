
<!doctype html>
<html lang="en">
<head>
    <!-- layout app -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Discord Manager</title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="/js/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/60010d6147.js" crossorigin="anonymous"></script>
    <link href="/css/style.css" rel="stylesheet">
    <script src="/js/searchbar.js"></script>

    @yield('script_include')
    @yield('webgl_include')
    @yield('script')
</head>

@yield('openbody')

@yield('header')
@yield('content')
@yield('footer')

</body>
</html>
