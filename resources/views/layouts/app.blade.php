<!DOCTYPE html>
<html lang="vn">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP QUÂN ÁO</title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    {{-- header --}}
    @include('layouts.header')
    {{-- header --}}

    {{-- content --}}
    @yield('content')
    {{-- content --}}

    {{-- footer --}}
    @include('layouts.footer')
    {{-- footer --}}
    {{-- <!-- js --> --}}
    <script>
        var MenuItems = document.getElementById("MenuItems");

        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px";
            }
            else {
                MenuItems.style.maxHeight = "0px";
            }
        }
    </script>
    <script>
        var LoginForm = document.getElementById("LoginForm");
        var RegForm = document.getElementById("RegForm");

        var Indicator = document.getElementById("Indicator");

            function register(){
                RegForm.style.transform = "translateX(0px)";
                LoginForm.style.transform = "translate(0px)";
                Indicator.style.transform = "translate(100px)";
            }

            function login(){
                RegForm.style.transform = "translateX(300px)";
                LoginForm.style.transform = "translate(300px)";
                Indicator.style.transform = "translate(0px)";
            }

    </script>
</body>

</html>
