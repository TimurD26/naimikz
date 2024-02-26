<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller{

    public function create(Request $request)
    {
     
        $data = $request->validate([
            'category_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'isModerated' => ['required', 'boolean'],
            'text' => ['required', 'string'],
            'url_to_photo' => ['required', 'string'],
            'sum' => ['required', 'integer'],
            'tel_number' => ['required', 'string'],
            'address' => ['required', 'string'],
            'isActive' => ['required', 'boolean'],
          ]);
        //   dd($data);

        $order = Order::create($data);

     return $order;
    }
    public function get_all()
    {
        $orders=Order::paginate(1500);
        // item();
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
    public function item_user_id($user_id, Request $request) {
        // $order = Order::find($user_id);
        // $record = Order::where('user_id', $user_id)->firstOrFail();
        $records = Order::where('user_id', $user_id)->get();
        // dd($order);
        return response()->json($records);
        // return $order;
    }
}