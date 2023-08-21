@extends('layouts.admin')

@section('css1')
    <link href="{{ asset('css/table.css') }}">
@endsection

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('title')
    <title>User</title>
@endsection

@section('content')

    <div class="content-wrapper">
        @include('admin.partials.content-header',['name' => 'User','key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('users.create') }}"class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">
                        <div class="table-wrap">
                            <table class="table table-responsive-xl">
                                <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user as $users)
                                <tr class="alert" role="alert">
                                    <td>
                                        <label class="checkbox-wrap checkbox-primary">
                                            <input type="checkbox" >
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td>{{ $users->name }}</td>
                                    <td class="d-flex align-items-center">
                                        <div class="email">
                                            <span>{{ $users->email }}</span>
                                        </div>
                                    </td>
                                    <td class="status">
                                        <a href="{{ route('users.edit',['id'=>$users->id]) }}" style="text-decoration: none" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('users.delete',['id'=>$users->id]) }}" style="text-decoration: none" class="btn btn-danger">Delete</a>
                                    </td>

                                    <td>
                                        <a href="a.com" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        {{$user->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    </div>

    <script src="{{ asset('js/popper.js') }}"></script>


@endsection

@section('js')
    <script src="{{ asset('js/main.js') }}"></script>
@endsection
