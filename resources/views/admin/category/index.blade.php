@extends('layouts.admin')

@section('title')
    <title>Trang chu</title>
@endsection

@section('content')

<div class="content-wrapper">
    @include('admin.partials.content-header',['name' => 'Category','key' => 'List'])
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('categories.create') }}"class="btn btn-success float-right m-2">Add</a>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tênh danh mục</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                      <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                        <td>
                            <a href="{{Route('categories.edit',['id'=>$category->id])}}" class="btn btn-default">Edit</a>
                            <a href="{{Route('categories.delete',['id'=>$category->id])}}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            <div class="col-md-12">
                {{$categories->links('pagination::bootstrap-4')}}
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
</div>

@endsection
