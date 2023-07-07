<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class errorcontroller extends Controller
{
    function index()  {
        return view('error');
    }
}
