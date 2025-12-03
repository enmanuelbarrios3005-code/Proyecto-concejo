<?php
namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('news.index', compact('news'));
    }

    public function welcome()
    {
        $news = News::all();
        $videos = \App\Models\Video::all();
        return view('welcome', compact('news', 'videos'));
    }

    public function create()
    {
        $news = News::all();
        return view('news.create', compact('news'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Obtener el nombre original de la imagen
            $originalName = $request->file('image')->getClientOriginalName();
            // Almacenar la imagen con el nombre original en la carpeta 'images'
            $path = $request->file('image')->storeAs('images', $originalName, 'public');
        }

        $news = new News();
        $news->title = $validated['title'];
        $news->description = $validated['description'];
        $news->image = $path;
        $news->video = $validated['video'] ?? null;
        $news->save();

        return redirect()->route('news.index')->with('success', 'Noticia creada exitosamente.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        
        // Eliminar la imagen del almacenamiento
        if ($news->image) {
            Storage::delete('/' . $news->image);
        }
        
        // Eliminar la noticia de la base de datos
        $news->delete();

        return redirect()->route('news.create');
    }
}