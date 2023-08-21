@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.partials.content-header',['name'=>'Category','key'=>'Add'])
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form method='POST' action="{{ Route('categories.store') }} ">
                        @csrf
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input  class="form-control"
                                    placeholder="Nhập tên danh mục"
                                    name="name"
                            >
                        </div>
                        <div class="form-group">
                            <label>Chọn danh mục cha</label>
                            <select class="form-control" name="parent_id">
                              <option value="0">Chọn danh mục cha</option>
                              {!!  $hmtlOptions !!}
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
