<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Product;
use App\Order;
use Purifier;
use Response;
use Auth;

class OrderController extends Controller
{

  public function __construct()
  {
      $this->middleware('jwt.auth', ['only' => ['placeOrder', 'updateOrder'] ]);
  }

  public function placeOrder (Request $request) {
    $rules = [
      'address' => 'required',
      'prodId' => 'required',
      'quantity' => 'required',
    ];

  $validator = Validator::make(Purifier::clean($request->all()), $rules);

  if ($validator->fails()) {
    return Response::json(['error' => 'all fields requried']);
  }

  else {
    $userId=Auth::user()->id;
    $check=Order::where('address', '=', $request->input('address'))->orWhere('quantity','=',
    $request->input('quantity'))->first();

    if(!empty($check)){
      return Response::json(['error' => 'order already exists']);
    }

  $product= Product::find($request->input('prodId'));
  if (empty($product)) {
    return Response::json(['error' => 'product does not exist']);
  }

  $order= new Order;


  $order->userId =
  Auth::user()->id;
  $order->address =
  $request->input('address');
  $order->prodId =
  $request->input('prodId');
  $order->quantity =
  $request->input('quantity');
  $order->comment =
  $request->input('comment');


  $order->cost=
  $request->input('quantity')*$product->price;

  if ($product->availability=0) {
    return Response::json(['error'=>'product out of stock']);
  }

  $order->save();

  return Response::json(['success' => 'Order placed']);

}}

  public function cancelOrder($id)
  {

    $order=Order::find($id);
    $user=Auth::user();
    if ($user->roleId!=1 || $user->id!= $order->userId){
      return Response::json(['error' => 'access denied']);
    }

    $product = Order::find($id);
    $product->delete();

    return Response::json(['success' => 'Order Cancelled']);

  }


  public function updateOrder($id, Request $request)
  {

    $order=Order::find($id);
    $user=Auth::user();
    if ($user->roleId!=1 || $user->id!= $order->userId){
      return Response::json(['success' => 'acess denied']);
    }

    $rules = [
      'address' => 'required',
      'prodId' => 'required',
      'quantity' => 'required',
    ];


  $validator = Validator::make(Purifier::clean($request->all()), $rules);

  if ($validator->fails()) {
    return Response::json(['error' => 'all fields requried']);
  }

  else {
    $userId=Auth::user()->id;
    $check=Order::where('address', '=', $request->input('address'))->orWhere('quantity','=',
     $request->input('quantity'))->first();

    if(!empty($check)){

    }
  }

    $order = Order::find($id);

    $order->userId =
    Auth::user()->id;
    $order->address =
    $request->input('address');
    $order->prodId =
    $request->input('prodId');
    $order->quantity =
    $request->input('quantity');
    $order->comment =
    $request->input('comment');


    $order->save();

    return Response::json(['success' => 'Order Updated.']);
  }

  public function showOrder($id)
  {
    $order = Order::find($id);

    return Response::json($order);
  }


public function orderIndex()
{
  $user=Auth::user();
  if ($user->roleId != 1)
  {
    return Response::json(['error' => "not allowed"])
  };

  $orders = Order::all();

  return Response:: json($orders);
}
}
