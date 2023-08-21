@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('admin.partials.content-header',['name'=>'Category','key'=>'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form method='POST' action="{{ Route('categories.update',['id'=>$category->id]) }} ">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input  type="text"
                                        class="form-control"
                                        value="{{$category->name}}"
                                        name="name"
                                        placeholder="Nhập tên danh mục"
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
