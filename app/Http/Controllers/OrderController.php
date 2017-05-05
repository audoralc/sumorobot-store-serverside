<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function placeOrder (Request $request) {
    $rules = [
      'userId' => 'required';
      'address' => 'required';
      'prodId' => 'required';
      'quantity' => 'required';
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
  $order->userId =
  $request->input('userId');
  $order->address =
  $request->input('address');
  $order->prodId-> input('prodId');
  $order->quantity =
  $request->input('quantity');
  $order->comment =
  $request->input('comment');

  $order->save();

  }

  public function cancelOrder($id)
  {
    $product = Order::find($id);
    $product->delete();

    return Respone::json(['success' => 'Order Cancelled']);

  }

}
