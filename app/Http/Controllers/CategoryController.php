<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Response;
use Illuminate\Support\Facades\Validator;
use Purifier;

class CategoryController extends Controller
{
    public function index()
    {
      $category = Category::all();

      return Response::json($category);
    }

    public function storeCategory(Request $request)
    {
      $rules = [
        'category' => 'required',
      ];

      $validator = Validator::make(Purifier::clean ($request->all()), $rules);

      $category = new Category;
      $category->category =
      $request->input('category');

      $category->save();
    }

    public function updateCategory($id, Request $request)
    {
      $rules = [
        'category' => 'required',
      ];

      $validator = Validator::make(Purifier::clean ($request->all()), $rules);

      $category = Category::find($id);

      $category->category =
      $request->input('category');

      $category->save();

      return Response::json(['success' => 'Category Updated.']);
    }

    public function showCategory($id)
    {
      $category = Category::find($id);

      return Response::json($category);
    }

    public function deleteCategory($id)
    {
      $category = Category::find($id);

      $category->delete();

      return Response::json(['success' => "Category deleted."]);
    }
}
