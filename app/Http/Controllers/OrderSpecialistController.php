<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderSpecialistController extends Controller
{
    public function create(Request $request)
    {
     
        $data = $request->validate([
            'order_id' => ['required', 'integer'],
            'user_id' => ['required', 'boolean'],
        ]);
        //   dd($data);

        $orderSpecialist = OrderSpecialist::create($data);
     return $orderSpecialist;
    }
    public function get_all()
    {
        $orderSpecialist=OrderSpecialist::paginate(15);
        item();
        return $orderSpecialist;
    }
    public function update($id, Request $request )
    {
        $orderSpecialist=OrderSpecialist::find($id);
 //dd($request->category_id);
        $orderSpecialist->order_id = $request->order_id;
        $orderSpecialist->user_id = $request->user_id;
     
        $order->save();

        return $order;
    }
    public function destroy($id)
    {
        $orderSpecialist=OrderSpecialist::find($id);
        
        $orderSpecialist->delete();
        // $cabinet->save();
        return $order;
    }
}
