<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
    public function newfunction(){
        return view('newView');
    }
    public function login(){
        return view('login');
    }
    
}