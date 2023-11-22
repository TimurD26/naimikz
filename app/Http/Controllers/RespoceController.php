<?php

namespace App\Http\Controllers;
use App\Models\Responce;
use Illuminate\Http\Request;

class RespoceController extends Controller
{
    public function create(Request $request)
    {
        $respoce = new Responce();
        
        
    }
    public function get_all()
    {
        $users=Order::paginate(15);
        return $users;
    }
}
