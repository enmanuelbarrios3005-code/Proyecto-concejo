<?php

namespace App\Http\Controllers;

use App\Models\Acuerdos;
use App\Models\Ordenanza;
use App\Models\Gaseta;
use App\Models\Resolucion;
use App\Models\User;
use App\Models\Expediente;
use App\Models\Ordinarias;
use App\Models\Extraordinarias;
use App\Models\Solemne;
use App\Models\Especiales;
use App\Models\News;
use App\Models\Video; // Importar el modelo Video
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $acuerdos = Acuerdos::all();
        $conteoAcuerdos = $acuerdos->count();
        
        $ordenanzas = Ordenanza::all();
        $conteoOrdenanzas = $ordenanzas->count();
        
        $gasetas = Gaseta::all();
        $conteoGasetas = $gasetas->count();
        
        $resoluciones = Resolucion::all();
        $conteoResoluciones = $resoluciones->count();
        
        $usuarios = User::all();
        $conteoUsuarios = $usuarios->count();
        
        $expedientes = Expediente::all();
        $conteoExpedientes = $expedientes->count();

        $ordinarias = Ordinarias::all();
        $conteoOrdinarias = $ordinarias->count();

        $extraordinarias = Extraordinarias::all();
        $conteoExtraordinarias = $extraordinarias->count();

        $solemne = Solemne::all();
        $conteoSolemne = $solemne->count();

        $especiales = Especiales::all();
        $conteoEspeciales = $especiales->count();

        $news = News::all(); // Obtener todas las noticias
        $conteoNews = $news->count(); // Contar la cantidad de noticias

        $videos = Video::all(); // Obtener todos los videos
        $conteoVideos = $videos->count(); // Contar la cantidad de videos

        return view('home', compact(
            'conteoAcuerdos', 
            'conteoOrdenanzas', 
            'conteoGasetas', 
            'conteoResoluciones', 
            'conteoUsuarios', 
            'conteoExpedientes',
            'conteoOrdinarias',
            'conteoExtraordinarias',
            'conteoSolemne',
            'conteoEspeciales',
            'conteoNews',
            'conteoVideos' // Agregar el conteo de videos
        ));
    }
}
