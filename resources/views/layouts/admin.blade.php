<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="lang={{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('title')

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/crud.css')}}">
    @yield('css1')

    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div id="app" class="wrapper">

    <App />
    @vite('resources/js/app.js')
  <!-- Navbar -->
    {{-- @include('admin.partials.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('admin.partials.siderbar')
  <!-- Content Wrapper. Contains page content -->
    @yield('content')
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('admin.partials.footer') --}}
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->

<script src="{{ asset('admin/dist/js/adminlte.min.js')}}"></script>
<script src="{{ asset('js/script.js') }}"></script>

<script>
$('#delete-selected').on('click', function() {
    let selectedProducts = [];

    $('.product-checkbox:checked').each(function() {
        selectedProducts.push($(this).val());
    });

    if (selectedProducts.length === 0) {
        alert('Vui lòng chọn ít nhất 1 sản phẩm');
        return;
    }

    if (confirm('Bạn có chắc chắn sẽ xoá sản phẩm này chứ?')) {
        $.ajax({
            url: "{{ route('product.deleteMultiple') }}",
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "products": selectedProducts
            },
            success: function(response) {
                location.reload();
            },
            error: function(err) {
                alert('Có lỗi khi xoá. Vui lòng thử lại');
            }
        });
    }
});
$(document).on('click', '.delete-product', function(e) {
    e.preventDefault();

    let productId = $(this).data('id');

    if (confirm('Bạn có muốn xoá sản phẩm này không?')) {
        $.ajax({
            url: `/admins/product/delete/${productId}`,
            method: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                if(response.success) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert('Có lỗi khi xoá. Vui lòng thử lại');
                }
            },
            error: function(err) {
                alert('Có lỗi khi xoá. Vui lòng thử lại');
            }
        });
    }
});
</script>
@yield('js')
</body>
</html>
