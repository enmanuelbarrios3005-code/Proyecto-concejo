<?php
namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('videos.index', compact('videos'));
    }

    public function welcome()
    {
        $videos = Video::all();
        $news = \App\Models\News::all();
        return view('welcome', compact('videos', 'news'));
    }

    public function create()
    {
        $videos = Video::all();
        return view('videos.create', compact('videos'));
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'required|file|mimes:mp4,avi,mov|max:20480', // 20 MB máximo
        ]);

        // Obtener el nombre original del video
        $originalName = $request->file('video')->getClientOriginalName();
        // Almacenar el video con el nombre original
        $path = $request->file('video')->storeAs('videos', $originalName, 'public');

        // Crear el video en la base de datos
        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'video' => $path,
        ]);

        // Establecer mensaje de éxito
        return redirect()->route('videos.index')->with('success', 'Video cargado con éxito');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        // Eliminar el video del almacenamiento
        Storage::delete('/' . $video->video);
        // Eliminar el video de la base de datos
        $video->delete();
        return redirect()->route('videos.index');
    }

    public function apiIndex()
    {
        return Video::all();
    }
}