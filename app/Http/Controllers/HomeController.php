<?php

namespace App\Http\Controllers;
use resources\views\front\home;


use Illuminate\Http\Request;

class HomeController extends Controller
{
   //This method will show our home page
   public function index()
   {
return view('front.home');
   }

}
