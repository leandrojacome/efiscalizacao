<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HashController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $hash = null)
    {
        if(is_null($hash) && ($hash !== md5(date('Y-m-d'))))
        {
            return view('errors.404');
        }
        else
        {
            return redirect()->to('/login');
        }
    }
}
