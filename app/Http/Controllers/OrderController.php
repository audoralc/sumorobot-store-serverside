<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function placeOrder (Request $request) {
    $rules = [
      'userId' => 'required',
      'address' => 'required',
      'prodId' => 'required',
      'quantity' => 'required',
    ]
  };

  $validator = Validator::make(Purifier::clean($request->all()), $rules);

  if ($validator->fails()) {
    return Response::json(['error' => 'all fields requried']);
  }

  else {
    check=Order::where('userId', '=', $request->input('userId'))->orWhere('address', '=', $request->(input('address')))->orWhere('quantity','=', $request(input->('quantity')))->first();

    if(!empty($check)){

    }
  }
$order= new Order;


$subtotal= $request->input('subtotal');
$total =  $subtotal + 10.00;



  $order->userId =
  Auth::user()->id;
  $order->address =
  $request->input('address');
  $order->prodId-> input('prodId');
  $order->quantity =
  $request->input('quantity');
  $order->comment =
  $request->input('comment');
  $order->total =$total;

  $order->save();

  }

  public function cancelOrder($id)
  {
    $product = Order::find($id);
    $product->delete();

    return Respone::json(['success' => 'Order Cancelled']);

  }


  public function updateOrder($id, Request $request)
  {
    $order = Order::find($id);

    $order->userId =
    $request->input('userId');
    $order->address =
    $request->input('address');
    $order->prodId-> input('prodId');
    $order->quantity =
    $request->input('quantity');
    $order->comment =
    $request->input('comment');
    $order->total =$total;

    $order->save();

    return Response::json(['success' => 'Order Updated.'])
  }

  public function showOrder($id)
  {
    $order = Order::find($id);

    return Response::json($user);
  }
}
