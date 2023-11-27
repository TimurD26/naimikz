<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller{

    public function create(Request $request)
    {
     $order = new Order();

     $order->category_id = $request->category_id;
     $order->isModerated = $request->isModerated;
     $order->text = $request->text;
     $order->url_to_photo = $request->url_to_photo;
     $order->sum = $request->sum;
     $order->tel_number = $request->tel_number;
     $order->address = $request->address;
     $order->isActive = $request->isActive;

     $order->save();
     return $order;
    }
    public function get_all()
    {
        $orders=Order::paginate(15);
        return $orders;
    }
    public function update($id, Request $request )
    {
        $order=Order::find($id);
 //dd($request->category_id);
        $order->category_id = $request->category_id;
        $order->isModerated = $request->isModerated;
        $order->text = $request->text;
        $order->url_to_photo = $request->url_to_photo;
        $order->sum = $request->sum;
        $order->tel_number = $request->tel_number;
        $order->address = $request->address;
        $order->isActive = $request->isActive;
        $order->save();

        return $order;
    }
    public function destroy($id)
    {
        $order=Order::find($id);
        
        $order->delete();
        // $cabinet->save();
        return $order;
    }

    public function item($id, Request $request) {
        $order = Order::with('specs')->findOrFail($id);

        // dd($order);
        return response()->json($order);
        // return $order;
    }
}