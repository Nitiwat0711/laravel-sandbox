<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        return view('pages.index');
    }

    public function  show($id) {
        return view('pages.show',[
            'name' => 'Samantha',
            'id' => $id,
            'text' => '<h3>h3 Text</h3>',
            'array' => []
        ]);
    }
}
