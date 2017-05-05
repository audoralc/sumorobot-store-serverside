<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Response;

class CategoryController extends Controller
{
    public function index()
    {
      $categories = Category::all();

      return Response::json($categories);
    }

    public function store(Request $request)
    {
      $category = new Category;
      $category->category =
      $request->input('category');

      $category->save();
    }

    public function update($id, Request $request)
    {
      $category = Category::find($id);

      $category->category =
      $request->input('category');

      $category->save();

      return Response::json(['success' => 'Category Updated.']);
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
