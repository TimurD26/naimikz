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
            'spec_id' => ['required', 'integer'],
          ]);
        $respoce = new Respoce();
        $respoce->order_id = $request->order_id;
        $respoce->spec_id = $request->spec_id;

        $respoce->save();
        return $respoce;
    }
    public function get_all_Respoce()
    {
        $users=Respoce::paginate(15);
        return $users;
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
