@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('admin.partials.content-header',['name' => 'menus','key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('menus.create') }}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <div id="menu-list">
{{--                            AJAX phân trang--}}
                            @include('admin.menus.page_list')
                        </div>
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th scope="col">#</th>--}}
{{--                                <th scope="col">Tên Menu</th>--}}
{{--                                <th scope="col">Action</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach( $menus as $menu)--}}
{{--                                <tr>--}}
{{--                                    <th scope="row">{{$menu->id}}</th>--}}
{{--                                    <td>{{$menu->name}}</td>--}}
{{--                                    <td>--}}
{{--                                        <a href="{{ Route('menus.edit',['id'=>$menu->id])}}" class="btn btn-default">Edit</a>--}}
{{--                                        <a href="{{ Route('menus.delete',['id'=>$menu->id])}}" class="btn btn-danger">Delete</a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
                    </div>
                    <div class="col-md-12">
{{--                        {{ $menus->appends(['items_per_page' => request('items_per_page')])->links('pagination::bootstrap-4') }}--}}
{{--                        <form method="get" action="{{ route('menus.index') }}" style="margin-bottom: 20px;">--}}
{{--                            <select name="items_per_page" onchange="this.form.submit()">--}}
{{--                                <option value="5" {{ request('items_per_page') == 5 ? 'selected' : '' }}>5 mục/trang</option>--}}
{{--                                <option selected value="10" {{ request('items_per_page') == 10 ? 'selected' : '' }}>10 mục/trang</option>--}}
{{--                                <option value="20" {{ request('items_per_page') == 20 ? 'selected' : '' }}>20 mục/trang</option>--}}
{{--                                <option  value="50" {{ request('items_per_page') == 50 ? 'selected' : '' }}>50 mục/trang</option>--}}
{{--                            </select>--}}
{{--                        </form>--}}

{{--                        --}}


                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Khi thay đổi giá trị trong dropdown
            $('select[name="items_per_page"]').on('change', function() {
                fetch_data();
            });

            // Khi nhấp vào liên kết phân trang
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page = 1) {
                var items_per_page = $('select[name="items_per_page"]').val();

                $.ajax({
                    url: '/admins/menus?page=' + page + '&items_per_page=' + items_per_page,
                    success: function(data) {
                        $('#menu-list').html(data);
                    }
                });
            }
        });
    </script>

@endsection
