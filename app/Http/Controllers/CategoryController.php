<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Str;
use Illuminate\Database\Query\Builder;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function create($parent_Id = '')
    {
        $hmtlOptions =$this->getCategory(0);
        return view('admin.category.add', compact('hmtlOptions'));
    }


    public function index()
    {
        $categories = $this -> category -> paginate(5);
        return view('admin.category.index',compact('categories'));
    }

    public function store(Request $request){
        $this->category->create([
            'name' => $request ->name,
            'parent_id' => $request ->parent_id,
            'slug' => str::slug($request->name),
        ]);
        return redirect()->route('categories.index');
    }

    public function getCategory($parent_Id){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $hmtlOptions = $recusive->CategoriesShow($parent_Id);
        return $hmtlOptions;
    }

    public function edit($id){
        $category = $this->category->find($id);
        $hmtlOptions = $this->getCategory($category->parent_id);
        return view('admin.category.edit',compact('category','hmtlOptions'));
    }

    public function update($id, Request $request){
        $this->category->find($id)->update([
            'name' => $request ->name,
            'parent_id' => $request ->parent_id,
            'slug' => str::slug($request->name),
        ]);
        return redirect()->route('categories.index');
    }

    public function detele($id){
        $this->category::find($id)->delete();
        return redirect()->route('categories.index');
    }
}
