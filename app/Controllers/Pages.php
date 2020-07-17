<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];

        return view('pages/home', $data);
    }
    public function about()
    {
        $data = [
            'title' => 'about me'
        ];

        return view('pages/about', $data);
    }
}
