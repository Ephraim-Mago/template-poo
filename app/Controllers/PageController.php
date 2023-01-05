<?php

namespace App\Controllers;

class PageController extends Controller
{
    public function index()
    {
        return $this->view('welcome');
    }
}