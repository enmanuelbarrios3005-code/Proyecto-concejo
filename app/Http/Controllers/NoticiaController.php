<?php
namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::all();
        return response()->json($noticias);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'fecha' => 'required|date',
        ]);

        $noticia = Noticia::create($request->all());
        return response()->json($noticia, 201);
    }

    public function update(Request $request, Noticia $noticia)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'fecha' => 'required|date',
        ]);

        $noticia->update($request->all());
        return response()->json($noticia);
    }

    public function destroy(Noticia $noticia)
    {
        $noticia->delete();
        return response()->json(null, 204);
    }
}
