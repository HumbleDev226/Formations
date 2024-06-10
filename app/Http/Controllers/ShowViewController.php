<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShowViewController extends Controller
{
    function showView(string $view ){
        if(View::exists($view)){
            return view($view);
        }
        else{
            return view('erreur');
        }
    
    }
}
