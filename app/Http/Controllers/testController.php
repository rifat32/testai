<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(["test" => $request->name]);
    }
}
