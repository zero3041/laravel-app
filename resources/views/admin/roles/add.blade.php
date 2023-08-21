@extends('layouts.admin')

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('title')
    <title>Role add</title>
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
    @include('admin.partials.content-header',['name'=>'Role','key'=>'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form method='POST' action="{{ route('users.store') }}">
                            @csrf
                            <div class="form-group">
                                <label>Tên Role</label>
                                <input  class="form-control"
                                        placeholder="Nhập tên user"
                                        name="name"
                                >
                            </div>
                            <div class="form-group">
                                <label>Mô tả role</label>
                                <textarea  class="form-control"
                                        placeholder="Nhập Email"
                                        name="display_name"
                                ></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
