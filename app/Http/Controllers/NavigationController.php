<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Comentario;

class NavigationController extends Controller
{

    public function consulta()
    {
        $doctores = Doctor::select('nombre', 'apellido', 'especialidad')->get();

        return view("vistas.portal.cita_consulta", compact('doctores'));
    }

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
        $noticias = Noticia::orderBy('created_at', 'desc')->paginate(4);

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

        if (!$noticia) {
            return redirect()->route('noticias')->with('error', 'Noticia no encontrada');
        }

        $sessionKey = 'noticia_vista_' . $id;

        // Solo contar la vista si no ha sido vista antes en esta sesión
        if (!session()->has($sessionKey)) {
            $noticia->increment('vistas');
            session()->put($sessionKey, true);
        }

        // 🔽 Obtener los comentarios aprobados relacionados con esta noticia
        $comentarios = Comentario::where('noticia_id', $id)
            ->where('aprobado', true)
            ->latest()
            ->get();

        return view('vistas.portal.mostrar_noticia', compact('noticia', 'comentarios'));
    }

    public function like($id)
    {
        $sessionKey = 'noticia_liked_' . $id;

        if (session()->has($sessionKey)) {
            return response()->json(['message' => 'Ya diste like'], 403);
        }

        $noticia = Noticia::findOrFail($id);
        $noticia->increment('likes');

        session()->put($sessionKey, true);

        return response()->json(['likes' => $noticia->likes]);
    }
    public function compartir($id)
    {
        $sessionKey = 'noticia_compartida_' . $id;

        if (session()->has($sessionKey)) {
            return response()->json(['message' => 'Ya fue compartido'], 403);
        }

        $noticia = Noticia::findOrFail($id);
        $noticia->increment('compartidos');

        session()->put($sessionKey, true);

        return response()->json(['compartidos' => $noticia->compartidos]);
    }

    public function comentar(Request $request, $id)
    {
        $request->validate([
            'comentario' => 'required|string|max:200'
        ]);


        Comentario::create([
            'noticia_id' => $id,
            'contenido' => $request->comentario,
        ]);

        Noticia::where('id', $id)->increment('comentarios'); // ✅ Aquí actualizas el contador

        return redirect()->back()->with('success', 'Comentario publicado');
    }

    public function likeComentario($id)
    {
        $sessionKey = 'comentario_liked_' . $id;

        if (session()->has($sessionKey)) {
            return response()->json(['message' => 'Ya diste like'], 403);
        }

        $comentario = Comentario::findOrFail($id);
        $comentario->increment('likecomentario');

        session()->put($sessionKey, true);

        return response()->json(['likecomentario' => $comentario->likecomentario]);
    }

    public function contactanos()
    {
        return view('vistas.portal.contactanos');
    }


}
