<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends ParentController
{
    public function index()
    {
        return view('pages.about',$this->data);
    }
}
