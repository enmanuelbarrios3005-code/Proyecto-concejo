<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use App\Models\Expediente;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class ExpedienteController extends Controller
{
    public function index()
    {
        $expedientes = Expediente::with('user')->get();
        $usuarios = User::all();
        $documentos = Documento::all(); // Obtener todos los documentos
        return view('expedientes.index', compact('expedientes', 'usuarios', 'documentos'));
    }


    
    public function create($userId)
    {
        $usuario = User::findOrFail($userId);
        $documentos = Documento::all(); // Obtener todos los documentos
        return view('expedientes.create', compact('usuario', 'documentos'));
    }
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'cedula' => 'required|string|max:20',
            'telefono' => 'required|string|max:15',
            'numero_cuenta' => 'required|string|max:20',
            'fecha_ingreso' => 'required|date', // Se eliminó la regla before_or_equal:today
            'user_id' => 'required|exists:users,id',
            'cargo' => 'nullable|string|max:100',
            'imagen' => 'nullable|image|max:2048',
            'expedientes.*' => 'required|file|mimes:pdf|max:2048',
        ]);
    
        // Verificar si ya existe un expediente para el usuario
        $expedienteExistente = Expediente::where('user_id', $request->user_id)->first();
        if ($expedienteExistente) {
            return redirect()->back()->with('error', 'No se puede crear más de un expediente por usuario.');
        }
    
        // Crear un nuevo expediente
        $expediente = new Expediente();
        $expediente->cedula = 'V-' . $request->cedula;
        $expediente->telefono = $request->telefono;
        $expediente->numero_cuenta = $request->numero_cuenta;
        $expediente->fecha_ingreso = $request->fecha_ingreso; // Se mantiene la asignación
        $expediente->user_id = $request->user_id;
        $expediente->cargo = $request->cargo; // Guardar el campo cargo
    
        // Guardar la imagen si se proporciona
        if ($request->hasFile('imagen')) {
            $expediente->imagen = $request->file('imagen')->store('imagenes', 'public');
        }
    
        // Guardar el expediente
        $expediente->save();
    
        // Guardar los archivos PDF asociados con el expediente
        if ($request->hasFile('expedientes')) {
            foreach ($request->file('expedientes') as $archivo) {
                $originalName = $archivo->getClientOriginalName();
                $path = 'public/expedientes/' . $originalName;
    
                // Verificar si el archivo ya existe y modificar el nombre si es necesario
                $counter = 1;
                while (Storage::exists($path)) {
                    $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
                    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                    $newName = $nameWithoutExtension . '_' . $counter . '.' . $extension;
                    $path = 'public/expedientes/' . $newName;
                    $counter++;
                }
    
                // Guardar el archivo y crear el documento asociado al expediente
                $archivoRuta = Storage::putFileAs('public/expedientes', $archivo, basename($path));
                Documento::create([
                    'nombre' => $originalName,
                    'ruta' => $archivoRuta,
                    'expediente_id' => $expediente->id,
                ]);
            }
        }
    
        return redirect()->route('expedientes.index')->with('success', 'Expediente creado exitosamente.');
    }
    

    public function show($id)
    {
        $expediente = Expediente::find($id);
        return view('expedientes.show', [
            'expediente' => $expediente,
            'nombreUsuario' => $expediente->user->name,
            'apellidoUsuario' => $expediente->user->apellido,
            'correoUsuario' => $expediente->user->email,
            'telefonoUsuario' => $expediente->telefono,
            'cedulaUsuario' => $expediente->cedula,
            'estadoUsuario' => $expediente->estado,
            'cargoUsuario' => $expediente->cargo // Añadir el cargo al array de datos
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cedula' => 'required|numeric|digits_between:1,8',
            'telefono' => 'required|numeric|digits_between:1,11',
            'numero_cuenta' => 'required|numeric|digits_between:1,20',
            'fecha_ingreso' => 'required|date|before_or_equal:today', // Validación adicional para la fecha
            'cargo' => 'nullable|string|max:100', // Validación para el campo cargo
        ]);
    
        $expediente = Expediente::findOrFail($id);
        $expediente->cedula = $request->cedula;
        $expediente->telefono = $request->telefono;
        $expediente->numero_cuenta = $request->numero_cuenta;
        $expediente->fecha_ingreso = $request->fecha_ingreso;
        $expediente->cargo = $request->cargo; // Actualizar el campo cargo
        $expediente->save();
    
        return redirect()->route('expedientes.show', $id)->with('success', 'Datos actualizados correctamente.');
    }
    
    public function destroy($id)
    {
        $expediente = Expediente::find($id);
        if (!$expediente) {
            return redirect()->route('expedientes.index')->with('error', 'Expediente no encontrado.');
        }
        $expediente->delete();
        return redirect()->route('expedientes.index')->with('success', 'Expediente eliminado con éxito.');
    }

    public function generatePDF($id)
    {
        $expediente = Expediente::with('user')->findOrFail($id);
        return view('expedientes.pdf', compact('expediente'));
    }

    public function edit($id)
    {
        $expediente = Expediente::findOrFail($id);
        return view('expedientes.edit', compact('expediente'));
    }

    public function download($id)
    {
        $expediente = Expediente::findOrFail($id);
        $pdf = PDF::loadView('expedientes.pdf', compact('expediente'));
        return $pdf->download('expediente_' . $expediente->id . '.pdf');
    }

    public function importarDocumentos(Request $request)
    {
        $request->validate([
            'expediente_id' => 'required|exists:expedientes,id',
            'documentos.*' => 'required|file|mimes:pdf|max:2048',
        ]);

        $expediente = Expediente::findOrFail($request->expediente_id);
        foreach ($request->file('documentos') as $archivo) {
            $originalName = $archivo->getClientOriginalName();
            $path = 'public/expedientes/' . $originalName;
            $counter = 1;

            while (Storage::exists($path)) {
                $nameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                $newName = $nameWithoutExtension . '_' . $counter . '.' . $extension;
                $path = 'public/expedientes/' . $newName;
                $counter++;
            }

            $archivoRuta = Storage::putFileAs('public/expedientes', $archivo, basename($path));
            Documento::create([
                'nombre' => $originalName,
                'ruta' => $archivoRuta,
                'expediente_id' => $expediente->id,
            ]);
        }

        return redirect()->route('expedientes.index')->with('success', 'Documentos importados exitosamente.');
    }


    

}





