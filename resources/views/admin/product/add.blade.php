@extends('layouts.admin')

@section('title')
    <title>Add product</title>
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
@endsection



@section('content')
<div class="content-wrapper">
{{--    <div class="col-md-12">--}}
{{--        @if ($errors->any())--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}
    @include('admin.partials.content-header',['name'=>'Product','key'=>'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form method='POST' action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input  class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Nhập tên sản phẩm"
                                        name="name"
                                        value="{{ old('name') }}"
                                >
                                @error('name')
                                <div class="alert alert-danger" style="margin-top: 5px;
                                                                       padding: 5px;
                                                                       height: 35px;"
                                    > {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mã sản phẩm</label>
                                <input  type="text"
                                        class="form-control @error('sku') is-invalid @enderror"
                                        name="sku"
                                        placeholder="Nhập mã sản phẩm"
                                        value="{{ old('sku') }}"
                                >
                                @error('sku')
                                <div class="alert alert-danger" style="margin-top: 5px;
                                                                       padding: 5px;
                                                                       height: 35px;"
                                > {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Giá Gốc Sản Phẩm</label>
                                <input  type="text"
                                        class="form-control @error('original_price') is-invalid @enderror"
                                        name="original_price"
                                        placeholder="Nhập giá gốc sản phẩm"
                                        value="{{ old('original_price') }}"
                                >
                                @error('original_price')
                                <div class="alert alert-danger" style="margin-top: 5px;
                                                                       padding: 5px;
                                                                       height: 35px;"
                                > {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Giá Khuyễn Mãi Sản Phẩm</label>
                                <input  type="text"
                                        class="form-control @error('discounted_price') is-invalid @enderror"
                                        name="discounted_price"
                                        placeholder="Nhập giá sản phẩm"
                                        value="{{ old('discounted_price') }}"
                                >
                                @error('discounted_price')
                                <div class="alert alert-danger" style="margin-top: 5px;
                                                                       padding: 5px;
                                                                       height: 35px;"
                                > {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <input  type="text"
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description"
                                        placeholder="Nhập mô tả"
                                        value="{{ old('description') }}"
                                >
                                @error('description')
                                <div class="alert alert-danger" style="margin-top: 5px;
                                                                       padding: 5px;
                                                                       height: 35px;"
                                > {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Size</label>
                                <input  type="text"
                                        class="form-control @error('sizes') is-invalid @enderror"
                                        name="sizes"
                                        placeholder="Nhập Size"
                                        value="{{ old('sizes') }}"
                                >
                                @error('sizes')
                                <div class="alert alert-danger" style="margin-top: 5px;
                                                                       padding: 5px;
                                                                       height: 35px;"
                                > {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Màu Sắc</label>
                                <input  type="text"
                                        class="form-control @error('colors') is-invalid @enderror"
                                        name="colors"
                                        placeholder="Nhập màu sắc sản phẩm"
                                        value="{{ old('colors') }}"
                                >
                                @error('colors')
                                <div class="alert alert-danger" style="margin-top: 5px;
                                                                       padding: 5px;
                                                                       height: 35px;"
                                > {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input  type="file"
                                        class="form-control-file"
                                        name="feature_image_path"
                                >
                            </div>
                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input  type="file"
                                        multiple
                                        class="form-control-file"
                                        name="image_path[]"
                                >
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    {!!  $hmtlOptions !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger" style="margin-top: 5px;
                                                                       padding: 5px;
                                                                       height: 35px;"
                                > {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nhập tag cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">

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

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script>
        $(".tags_select_choose").select2({
            tags: true,
            tokenSeparators: [',']
        })
        $(".select2_init").select2({
            placeholder: "Chọn Danh Mục",
            allowClear: true
        })
    </script>
@endsection
