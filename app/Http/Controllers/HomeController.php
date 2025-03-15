<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $noticias = Noticia::orderBy('created_at', 'desc')->take(3)->get();
         
        return view('vistas.portal.home', compact('noticias'));
        
    }
}
