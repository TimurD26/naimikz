<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $user=User::find($login);
        if ($user->password==$request->password)
        {

        }
    }
    public function 
}
