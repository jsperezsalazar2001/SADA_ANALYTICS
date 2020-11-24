<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function about(){
        $data = [];
        $data["title"] = __('about.title');
        return view('about')->with("data",$data);
    }
}