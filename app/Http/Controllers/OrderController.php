<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\order;

class OrderController extends Controller{

    public function create(Request $request)
    {
     $order = new Order();

     $order -> category_id=$request->category_id;
     $order -> isModerated=$request->isModerated;
     $order -> text=$request->text;
     $order -> url_to_photo=$request->url_to_photo;
     $order -> sum=$request->sum;
     $order -> tel_number=$request->tel_number;
     $order -> address=$request->address;
     $order -> isActive=$request->isActive;

     $order->save();
     return $order;
    }
    public function get_all()
    {
        $users=Order::all();
        return $users;
    }
    public function update($id, Request $request )
    {
        $cabinet=Order::find($id);

        $order -> category_id=$request->category_id;
        $order -> isModerated=$request->isModerated;
        $order -> text=$request->text;
        $order -> url_to_photo=$request->url_to_photo;
        $order -> sum=$request->sum;
        $order -> tel_number=$request->tel_number;
        $order -> address=$request->address;
        $order -> isActive=$request->isActive;
        $order->save();

        return $order;
    }
    public function destroy($id)
    {
        $cabinet=Cabinet::find($id);
        
        $cabinet->delete();
        // $cabinet->save();
        return $cabinet;
    }
}