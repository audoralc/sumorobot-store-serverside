<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
      $categories = Category::all();

      return Response::json($categories);
    }

    public function store(Request $request)
    {

    }

    public function update($id, Request $request)
    {

    }

    public function show($id)
    {
      $categories = Category::find($id);

      return Response::json($category); 
    }

    public function delete($id)
    {
      $categories = Category::find($id)

      $categories->delete();

      return Response::json(['success' => "Category deleted."]);
    }
}
