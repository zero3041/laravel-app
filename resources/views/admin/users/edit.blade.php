@extends('layouts.admin')

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('title')
    <title>User Edit</title>
@endsection

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script>
        $('.select2_init').select2({
            'placeholder' : 'Chọn vai trò'
        })
    </script>
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.partials.content-header',['name'=>'User','key'=>'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form method='POST' action="{{ route('users.update',['id' => $users->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label>Tên User</label>
                                <input  class="form-control"
                                        placeholder="Nhập tên user"
                                        name="name"
                                        value="{{ $users->name }}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input  class="form-control"
                                        placeholder="Nhập Email"
                                        name="email"
                                        value="{{ $users->email }}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input  type="password"
                                        class="form-control"
                                        placeholder="Nhập password"
                                        name="password"
                                >
                            </div>
                            <div class="form-group">
                                <label>Chọn vai trò</label>
                                <select name="role_id[]" class="form-control select2_init" name="" multiple>
                                    <option value=""></option>

                                    @php
                                        $roleIdsOfUser = $roleOfUser->pluck('roles.id')->toArray();
                                    @endphp

                                    @foreach($roles as $role)

                                        <option value="{{ $role->id }}" {{ in_array($role->id, $roleIdsOfUser, true) ? 'selected' : '' }}>{{ $role->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
