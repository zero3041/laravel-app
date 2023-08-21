<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Tên Menu</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($menus as $menu)
        <tr>
            <th scope="row">{{$menu->id}}</th>
            <td>{{$menu->name}}</td>
            <td>
                <a href="{{ Route('menus.edit',['id'=>$menu->id])}}" class="btn btn-default">Edit</a>
                <a href="{{ Route('menus.delete',['id'=>$menu->id])}}" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="col-md-12">
     {{ $menus->appends(['items_per_page' => request('items_per_page')])->links('pagination::bootstrap-4') }}
    <form method="get" action="{{ route('menus.index') }}" style="margin-bottom: 20px;">
        <select name="items_per_page" onchange="this.form.submit()">
            <option value="5" {{ request('items_per_page') == 5 ? 'selected' : '' }}>5 mục/trang</option>
            <option selected value="10" {{ request('items_per_page') == 10 ? 'selected' : '' }}>10 mục/trang</option>
            <option value="20" {{ request('items_per_page') == 20 ? 'selected' : '' }}>20 mục/trang</option>
            <option  value="50" {{ request('items_per_page') == 50 ? 'selected' : '' }}>50 mục/trang</option>
        </select>
    </form>
</div>
