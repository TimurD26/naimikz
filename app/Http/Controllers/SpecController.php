<?php

namespace App\Http\Controllers;
use App\Models\Respoce;
use App\Models\Spec;
use Illuminate\Http\Request;

class SpecController extends Controller
{
    public function create_Respoce(Request $request)
    {
        $request->validate([
            'order_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
          ]);
        $respoce = new Respoce();
        $respoce->order_id = $request->order_id;
        $respoce->user_id = $request->user_id;

        $respoce->save();
        return $respoce;
    }
    public function get_all_Respoce()
    {
        $users=Respoce::paginate(15);
        return $users;
    }
    public function get_respon_by_order_id($order_id, Request $request) {
        // $order = Order::find($user_id);
        // $record = Order::where('user_id', $user_id)->firstOrFail();
        $records = Respoce::where('order_id', $order_id)->get();
        // dd($order);
        return response()->json($records);
        // return $order;
    }
    public function create(Request $request)
    {
     $spec = new Spec();

     $spec->Full_name = $request->Full_name;
     $spec->Age = $request->Age;
     $spec->About = $request->About;
     $spec->Services_and_Prices = $request->Services_and_Prices;
     $spec->work_experience = $request->work_experience;
     $spec->url_to_photo = $request->url_to_photo;
     $spec->education = $request->education;

     $spec->save();
     return $spec;
    }
    public function get_all()
    {
        $specs=Spec::paginate(15);
        return $specs;
    }
    public function get_certain_specialist()
    {
        $spec=Spec::find($id);
        return $specs;
    }
    public function update($id, Request $request )
    {
        $spec=Spec::find($id);

        $spec->Full_name = $request->Full_name;
        $spec->Age = $request->Age;
        $spec->About = $request->About;
        $spec->Services_and_Prices = $request->Services_and_Prices;
        $spec->work_experience = $request->work_experience;
        $spec->url_to_photo = $request->url_to_photo;
        $spec->education = $request->education;

        $spec->save();
        return $spec;
    }
    public function destroy($id)
    {
        $spec=Spec::find($id);
        
        $spec->delete();
        
        return $spec;
    }
}
