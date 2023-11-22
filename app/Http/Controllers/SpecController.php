<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpecController extends Controller
{
    public function create_Respoce(Request $request)
    {
        $request->validate([
            'order_id' => ['required', 'integer'],
            'spec_id' => ['required', 'integer'],
          ]);
        $respoce = new Responce();
        $respoce->order_id = $request->order_id;
        $respoce->spec_id = $request->spec_id;
        
    }
    public function get_all_Respoce()
    {
        $users=Responce::paginate(15);
        return $users;
    }
    public function create(Request $request)
    {
     $spec = new Spec();

     $spec->Full_name = $request->Full_name;
     $spec->Age = $request->Age;
     $spec->About = $request->About;
     $spec->Services_and_:Prices = $request->Services_and_:Prices;
     $spec->work_experience = $request->work_experience;
     $spec->url_to_photo = $request->url_to_photo;
     $spec->education = $request->education;

     $spec->save();
     return $spec;
    }
    public function get_all()
    {
        $users=Spec::paginate(15);
        return $users;
    }
    public function update($id, Request $request )
    {
        $cabinet=Spec::find($id);

        $spec->Full_name = $request->Full_name;
        $spec->Age = $request->Age;
        $spec->About = $request->About;
        $spec->Services_and_:Prices = $request->Services_and_:Prices;
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
        // $cabinet->save();
        return $spec;
    }
}
