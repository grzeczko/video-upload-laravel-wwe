<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show() {
      $videos = Video::all()->sortByDesc("updated_at");

      return view('upload')->with([
        'videos' => $videos
      ]);
    }
}
