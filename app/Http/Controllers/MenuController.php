<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menuRecusive;

    public function __construct(MenuRecusive $menuRecusive, Menu $menu)
    {
        $this->menuRecusive = $menuRecusive;
        $this->menu = $menu;
    }

    public function index(Request $request)
    {
//        $itemsPerPage = $request->get('items_per_page', 10);
//        $menus = $this->menu->paginate($itemsPerPage);
//        return view('admin.menus.index', compact('menus'));


        $itemsPerPage = $request->get('items_per_page', 10);
        $menus = $this->menu->paginate($itemsPerPage);

        if ($request->ajax()) {
            return view('admin.menus.page_list', compact('menus'))->render();
        }

        return view('admin.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str::slug($request->name)
        ]);
        return redirect()->route('menus.index');
    }

    public function create()
    {
        $optionSelect = $this->menuRecusive->menuRecusiveAdd();
        return view('admin.menus.add', compact('optionSelect'));
        dd($optionSelect);
    }

    public function edit($id, Request $request)
    {
        $menuFollowIdEdit = $this->menu->find($id);
        $optionSelect = $this->menuRecusive->menuRecusiveEdit($menuFollowIdEdit->parent_id);
        return view('admin.menus.edit', compact('optionSelect', 'menuFollowIdEdit'));
    }

    public function update($id, Request $request)
    {
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str::slug($request->name)
        ]);
        return redirect()->route('menus.index');
    }

    public function delete($id)
    {
        $this->menu->find($id)->delete();
        return redirect()->route('menus.index');
    }
}
