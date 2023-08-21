@extends('layouts.admin')

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('title')
    <title>Role add</title>
@endsection

@section('js')
    <script>
        $('.checkbox_wrapper').on('click',function () {
            var $this = $(this);
            $this.parents('.card-header').find('.checkbox_children').prop('checked',$(this).prop('checked'));
        })
    </script>
@endsection

@section('content')

    <div class="content-wrapper">
    @include('admin.partials.content-header',['name'=>'Role','key'=>'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form method='POST' action="{{ route('roles.store') }}" style="width: 100%">
                        <div class="col-lg-12">
                                @csrf
                                <div class="form-group">
                                    <label>Tên Role</label>
                                    <input  class="form-control"
                                            placeholder="Nhập tên role"
                                            name="name"
                                    >
                                </div>
                                <div class="form-group">
                                    <label>Mô tả role</label>
                                    <textarea  class="form-control"
                                            placeholder="Nhập mô tả role"
                                            name="display_name"
                                    ></textarea>
                                </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                @foreach($permissionsParent as $permissionsParentItem)
                                <div class="card border-primary mb-3 col-md-12">
                                    <div class="card-header">
                                        <label>
                                            <input class="checkbox_wrapper" type="checkbox" value="">
                                        </label>
                                        Module {{ $permissionsParentItem->name }}
                                        <div class="row bg-secondary">
                                            @foreach($permissionsParentItem->permissionsChildrent as $permissionsChildrenItem)
                                                <div class="card-body col-md-3">
                                                    <h5 class="card-title">
                                                        <label>
                                                            <input name="permission_id[]" class="checkbox_children" type="checkbox" value="{{ $permissionsChildrenItem->id }}">
                                                        </label>
                                                        {{ $permissionsChildrenItem->name }}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
