<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Response;
use Illuminate\Support\Facades\Validator;
use Purifier;

class ProductController extends Controller
{
  public function indexProducts()
  {
   $products =  Product::all();

    return Response::json();
  }


  public function storeProduct(Request $request)
  {

    $rules = [
      'name' => 'required',
      'catId' => 'required',
      'availability' => 'required',
      'price' => 'required',
      'description' => 'required',
      'image' => 'required',
    ];

    $validator = Validator::make(Purifier::clean ($request->all()), $rules);

    $user=Auth::user();
    if ($user->roleId != 1)
    {
    return Response::json(['error' => "not allowed"])
    };

    $product = new Product;
    $product->name =
    $request->input('name');
    $product->catId =
    $request->input('catId');
    $product->availability =
    $request->input('availability');
    $product->price =
    $request->input('price');
    $product->description =
    $request->input('description');

    $image= $request->file('image');
    $imageName=
    $image->getClientOriginalName();
    $image->move('storage/', $imageName);

    $product->image=
    $request->root().'/storage/'.$imageName;

    $product->save();

    return Response::json(['success' => 'Product added']);
  }

  public function updateProduct($id, Request $request)
  {
    $rules = [
      'name' => 'required',
      'catId' => 'required',
      'availability' => 'required',
      'price' => 'required',
      'description' => 'required',
      'image' => 'required',
    ];

    $validator = Validator::make(Purifier::clean ($request->all()), $rules);

    $user=Auth::user();
    if ($user->roleId != 1)
    {
    return Response::json(['error' => "not allowed"])
    };

    $product = Product::find($id);

    $product->name =
    $request->input('name');
    $product->catId =
    $request->input('catId');
    $product->availability =
    $request->input('availability');
    $product->price =
    $request->input('price');
    $product->description =
    $request->input('description');

    $image=$request->file('image');
    $imageName=
    $image->getClientOriginalName();
    $image->move('storage/', $imageName);
    $product->image=
    $request->root().'/storage/'.$imageName;

    $product->save();

    return Response::json(['success' => 'Product Updated.']);
  }

  public function showProduct($id)
  {
    $product = Product::find($id);

    return Response::json($product);
  }

  public function deleteProduct($id)
  {
    $user=Auth::user();
    if ($user->roleId != 1)
    {
    return Response::json(['error' => "not allowed"])
    };

    $product = Product::find($id);
    $product->delete();

    return Respone::json(['success' => 'Product deleted.']);

  }
}
