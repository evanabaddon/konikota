<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Pertandingan;

class HomeController
{
    public function index()
    {
         // Mengambil data event dari database
         $events = Event::all();
         // Mengambil data pertandingan dari database
         $pertandingans = Pertandingan::all();

        
 
         // Kirim data event dan pertandingan ke view home.blade.php
         return view('home', compact('events', 'pertandingans'));
    }
}
