@extends('layouts.admin')

@section('title')
    <title>Edit product</title>
@endsection

@section('css1')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
@endsection



@section('content')
    <div class="content-wrapper">
        @include('admin.partials.content-header',['name'=>'Product','key'=>'Edit'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form method='POST' action="{{ route('product.update',['id' => $product->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input  class="form-control"
                                        placeholder="Nhập tên sản phẩm"
                                        name="name"
                                        value="{{ $product->name }}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Mã sản phẩm</label>
                                <input  type="text"
                                        class="form-control"
                                        name="sku"
                                        placeholder="Nhập mã sản phẩm"
                                        value="{{ $product->sku }}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Giá Gốc Sản Phẩm</label>
                                <input  type="text"
                                        class="form-control"
                                        name="original_price"
                                        placeholder="Nhập giá gốc sản phẩm"
                                        value="{{ $product->original_price }}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Giá Khuyễn Mãi Sản Phẩm</label>
                                <input  type="text"
                                        class="form-control"
                                        name="discounted_price"
                                        placeholder="Nhập giá sản phẩm"
                                        value="{{ $product->discounted_price }}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <input  type="text"
                                        class="form-control"
                                        name="description"
                                        placeholder="Nhập mô tả"
                                        value="{{ $product->description }}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Size</label>
                                <input  type="text"
                                        class="form-control"
                                        name="sizes"
                                        placeholder="Nhập Size"
                                        value="{{ $product->sizes }}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Màu Sắc</label>
                                <input  type="text"
                                        class="form-control"
                                        name="colors"
                                        placeholder="Nhập màu sắc sản phẩm"
                                        value="{{ $product->colors }}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input  type="file"
                                        class="form-control-file"
                                        name="feature_image_path"

                                >
                            <div class="col-md-12">
                                <div class="row">
                                    <img src="{{ $product->feature_image_path }}" alt="">
                                </div>
                            </div>

                            </div>
                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input  type="file"
                                        multiple
                                        class="form-control-file"
                                        name="image_path[]"
                                >
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach( $product->images as $image )
                                    <img src="{{ $image->image_path }}" alt="">
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    {!!  $hmtlOptions !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập tag cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                    @foreach( $product->tags as $tagItem )
                                    <option selected value="{{ $tagItem->name }}">{{ $tagItem->name }}</option>
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
