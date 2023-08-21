@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.partials.content-header',['name'=>'menus','key'=>'Add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form method='POST' action="{{ Route('menus.store') }} ">
                        @csrf
                        <div class="form-group">
                            <label>Tên menus</label>
                            <input  class="form-control"
                                    placeholder="Nhập tên menu"
                                    name="name"
                            >
                        </div>
                        <div class="form-group">
                            <label>Chọn menus cha</label>
                            <select class="form-control" name="parent_id">
                              <option value="0">Chọn menus cha</option>
                              {!! $optionSelect !!}
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
