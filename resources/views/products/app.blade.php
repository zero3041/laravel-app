<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Add to Cart</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    @yield('css')
</head>
<body>
<!-- partial:index.partial.html -->

    @include('products.header')

    @include('products.sidebar')

    @yield('content')

    @include('products.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- partial -->
<script  src="../../js/script.js"></script>

</body>
</html>
