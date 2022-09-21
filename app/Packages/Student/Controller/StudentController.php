<?php

namespace App\Packages\Student\Controller;


use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(['status' => true]);
    }

    public function store()
    {
        return response()->json(['status' => true]);
    }

    public function update()
    {
        return response()->json(['status' => true]);
    }

    public function show()
    {
        return response()->json(['status' => true]);
    }

    public function destroy()
    {
        return response()->json(['status' => true]);
    }
}