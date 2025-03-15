<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;

class NavigationController extends Controller
{
    public function nosotros()
    {
        return view('vistas.portal.nosotros');
    }

    public function especialidades()
    {
        return view('vistas.portal.especialidades');
    }

    public function noticias()
    {
        $noticias = Noticia::orderBy('created_at', 'desc')->paginate();

        return view('vistas.portal.noticias', compact('noticias'));
    }

    public function cita()
    {
        return view('vistas.cita.vista');
    }
    
    public function filtrarNoticias(Request $request)
    {
        $fecha = $request->input('fecha');

        $query = Noticia::query();

        if ($fecha) {
            $query->whereDate('created_at', $fecha);
        }

        $noticias = $query->orderBy('created_at', 'desc')->paginate();

        return view('vistas.portal.noticias', compact('noticias'));
    }



    public function show($id)
    {

        $noticia = Noticia::find($id);

        return view('vistas.portal.mostrarnNoticia', compact('noticia'));
    }


    

    public function contactanos()
    {
        return view('vistas.portal.contactanos');
    }

    
}
