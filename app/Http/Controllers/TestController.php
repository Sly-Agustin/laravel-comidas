<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    // TESTING
    public function test()
    {
        return view('test');
    }
}
