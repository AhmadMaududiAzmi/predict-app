<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index(){
        $output = shell_exec("python python/Untitled-1.py");
        return $output;
    }
}
