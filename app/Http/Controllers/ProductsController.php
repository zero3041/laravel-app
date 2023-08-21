<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Hello World
class ProductsController extends Controller
{
    public function index(){
        return view('products.index');
    }
}
