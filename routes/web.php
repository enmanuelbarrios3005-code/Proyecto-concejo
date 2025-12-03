<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrdenCompraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\SugerenciaController;
use App\Http\Controllers\RequerimientoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/legales', function () {
    return view('legales');
})->name('legales');

Route::get('/cetas', function () {
    return view('cetas');
})->name('cetas');

Route::get('/resol', function () {
    return view('resol');
})->name('resol');


Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');


/*
|LOgin registro
|
*/

Route::get('/', function () { return view('welcome');
});


Route::get('/login', 'Auth\LoginController@show')->name('login.show');
Route::get('/login', 'Auth\LoginController@login')->name('login.perform');
Route::get('/register', 'Auth\RegisterController@show')->name('register.show');
Route::post('/register', 'Auth\RegisterController@register')->name('register.perform');
Route::get('/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('reset');
Route::post('/reset', 'App\Http\Controllers\Auth\ResetPasswordController@resetPost')->name('reset.post');


Route::get('/offline', function () {
    return view('modules/laravelpwa/offline');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('/perform-logout', 'App\Http\Controllers\LogoutController@perform')->name('logout.perform');

use App\Http\Controllers\MiuserController;
use App\Http\Livewire\UserProfileImage;

// Rutas de miuser
Route::prefix('miuser')->group(function () {
    Route::get('/', [MiuserController::class, 'index'])->name('miuser.index'); // Listar usuarios
    Route::get('/create', [MiuserController::class, 'create'])->name('miuser.create'); // Mostrar formulario de creación
    Route::post('/', [MiuserController::class, 'store'])->name('miuser.store'); // Almacenar nuevo usuario
    Route::get('/{id}/edit', [MiuserController::class, 'edit'])->name('miuser.edit'); // Mostrar formulario de edición
    Route::put('/{id}', [MiuserController::class, 'update'])->name('miuser.update'); // Actualizar usuario
    Route::delete('/{id}', [MiuserController::class, 'destroy'])->name('miuser.destroy'); // Eliminar usuario

    // Rutas para cambiar contraseña y restablecer contraseña
    Route::post('/cambiar-contraseña', [MiuserController::class, 'updatePassword'])->name('cambiar.contraseña'); // Cambiar contraseña
    Route::post('/reset-password', [MiuserController::class, 'resetPassword'])->name('reset.password'); // Restablecer contraseña
});





use App\Http\Controllers\UserController;

// Otras rutas...

Route::middleware('web')->prefix('user')->group(function () {
    Route::get('cambiar-contraseña', [UserController::class, 'showChangePasswordForm'])->name('user.showChangePasswordForm');
    Route::put('cambiar-contraseña', [UserController::class, 'update'])->name('users.update');
});
Route::get('/list-users-roles', [App\Http\Controllers\UserController::class, 'listUsersWithRoles'])->name('list.users.roles');


Route::get('/listausuario/role/{id}', [App\Http\Controllers\UserController::class, 'editRole'])->name('listausuario.editRole');
Route::put('/listausuario/{id}/role', [App\Http\Controllers\UserController::class, 'updateRole'])->name('listausuario.updateRole');


Route::post('/users/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');

// Ruta para mostrar todos los usuarios
Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Ruta para actualizar el estado del usuario usando PATCH
Route::patch('/users/{id}/update-status', [UserController::class, 'updateStatus'])->name('users.updateStatus');

Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');



use App\Http\Controllers\ListausuarioController;

// Rutas de lista de usuarios
Route::prefix('listausuario')->group(function () {
    Route::get('/', [ListausuarioController::class, 'index'])->name('listausuario.index'); // Listar usuarios
    Route::post('/', [ListausuarioController::class, 'store'])->name('listausuario.store'); // Almacenar nuevo usuario
    Route::get('/{id}/edit', [ListausuarioController::class, 'edit'])->name('listausuario.edit'); // Mostrar formulario de edición
    Route::put('/{id}', [ListausuarioController::class, 'update'])->name('listausuario.update'); // Actualizar usuario
    Route::delete('/{id}', [ListausuarioController::class, 'destroy'])->name('listausuario.destroy'); // Eliminar usuario
    Route::get('/{id}', [ListausuarioController::class, 'show'])->name('listausuario.show'); // Mostrar un usuario específico
});

use App\Http\Controllers\InstrumentoslegalesController;

Route::get('/instrumentoslegales', [InstrumentoslegalesController::class, 'index'])->name('instrumentoslegales.index');
Route::post('/instrumentoslegales', [InstrumentoslegalesController::class, 'store'])->name('instrumentoslegales.store');
Route::delete('/instrumentoslegales/{fileName}', [InstrumentoslegalesController::class, 'destroy'])->name('instrumentoslegales.destroy');

use App\Http\Controllers\GasetasController;

Route::get('/gasetas', [GasetasController::class, 'index'])->name('gasetas.index');
Route::post('/gasetas', [GasetasController::class, 'store'])->name('gasetas.store');
Route::delete('/gasetas/{fileName}', [GasetasController::class, 'destroy'])->name('gasetas.destroy');
Route::get('/gasetas/download/{fileName}', [GasetasController::class, 'download'])->name('gasetas.download');
Route::get('obtenerConteoMensual', [GasetasController::class, 'obtenerConteoMensual']);






use App\Http\Controllers\OrdenanzasController;

Route::get('/ordenanzas', [OrdenanzasController::class, 'index'])->name('ordenanzas.index');
Route::post('/ordenanzas', [OrdenanzasController::class, 'store'])->name('ordenanzas.store');
Route::delete('/ordenanzas/{fileName}', [OrdenanzasController::class, 'destroy'])->name('ordenanzas.destroy');
Route::get('/ordenanzas/descargar/{fileName}', [OrdenanzasController::class, 'download'])->name('ordenanzas.download');

Route::get('getConteoMensual', [OrdenanzasController::class, 'getConteoMensual']);

use App\Http\Controllers\LegalesController;

Route::get('/legales', [LegalesController::class, 'index'])->name('legales');
Route::get('/legales/search', [LegalesController::class, 'search'])->name('legales.search');
Route::get('/cetas', [LegalesController::class, 'showCetas'])->name('cetas');
Route::get('/cetas/search', [LegalesController::class, 'searchCetas'])->name('cetas.search');
Route::get('/resol', [LegalesController::class, 'showResol'])->name('resol.index');
Route::get('/resol/search', [LegalesController::class, 'searchResol'])->name('resol.search');

Route::get('/acue', [LegalesController::class, 'showAcue'])->name('acue.index');
Route::get('/acue/search', [LegalesController::class, 'searchAcue'])->name('acues.search');




use App\Http\Controllers\ResolucionesController;

// Ruta para mostrar el índice de resoluciones
Route::get('/resoluciones', [ResolucionesController::class, 'index'])->name('resoluciones.index');

// Ruta para almacenar una nueva resolución
Route::post('/resoluciones/store', [ResolucionesController::class, 'store'])->name('resoluciones.store');

// Ruta para eliminar una resolución
Route::delete('/resoluciones/{fileName}', [ResolucionesController::class, 'destroy'])->name('resoluciones.destroy');

// Ruta para descargar una resolución
Route::get('/resoluciones/download/{fileName}', [ResolucionesController::class, 'download'])->name('resoluciones.download');

// Ruta para obtener el conteo mensual
Route::get('/obtenerConteoMensualPorAnio', [ResolucionesController::class, 'obtenerConteoMensualPorAnio'])->name('resoluciones.conteoMensualPorAnio');

use App\Http\Controllers\AcuerdosController; // Cambiado a AcuerdosController

// Ruta para mostrar el índice de acuerdos
Route::get('/acuerdos', [AcuerdosController::class, 'index'])->name('acuerdos.index');
// Ruta para almacenar un nuevo acuerdo
Route::post('/acuerdos/store', [AcuerdosController::class, 'store'])->name('acuerdos.store');
// Ruta para eliminar un acuerdo
Route::delete('/acuerdos/{fileName}', [AcuerdosController::class, 'destroy'])->name('acuerdos.destroy');
// Ruta para descargar un acuerdo
Route::get('/acuerdos/download/{fileName}', [AcuerdosController::class, 'download'])->name('acuerdos.download');
// Ruta para obtener el conteo mensual por año de los acuerdos
Route::get('/obtenerConteoMensualAcuerdosPorAnio', [AcuerdosController::class, 'obtenerConteoMensualAcuerdosPorAnio'])->name('acuerdos.conteoMensual');


use App\Http\Controllers\OrdinariasController;

Route::get('/ordinarias', [OrdinariasController::class, 'index'])->name('ordinarias.index');
Route::post('/ordinarias', [OrdinariasController::class, 'store'])->name('ordinaria.store');
Route::delete('/ordinarias/{fileName}', [OrdinariasController::class, 'destroy'])->name('ordinarias.destroy');
Route::get('/ordinarias/download/{fileName}', [OrdinariasController::class, 'download'])->name('ordinarias.download');
Route::get('/ordinarias/view/{fileName}', [OrdinariasController::class, 'view'])->name('ordinarias.view');
Route::get('/ordinarias/print/{fileName}', [OrdinariasController::class, 'print'])->name('ordinarias.print');

use App\Http\Controllers\ExtraordinariasController;

Route::get('/extraordinarias', [ExtraordinariasController::class, 'index'])->name('extraordinarias.index');
Route::post('/extraordinarias', [ExtraordinariasController::class, 'store'])->name('extraordinaria.store');
Route::delete('/extraordinarias/{fileName}', [ExtraordinariasController::class, 'destroy'])->name('extraordinarias.destroy');
Route::get('/extraordinarias/download/{fileName}', [ExtraordinariasController::class, 'download'])->name('extraordinarias.download');
Route::get('/extraordinarias/view/{fileName}', [ExtraordinariasController::class, 'view'])->name('extraordinarias.view');
Route::get('/extraordinarias/print/{fileName}', [ExtraordinariasController::class, 'print'])->name('extraordinarias.print');

use App\Http\Controllers\SolemneController; // Cambiado a SolemnesController

Route::get('/solemnes', [SolemneController::class, 'index'])->name('solemnes.index'); // Cambiado a solemnes
Route::post('/solemnes', [SolemneController::class, 'store'])->name('solemne.store'); // Cambiado a solemne
Route::delete('/solemnes/{fileName}', [SolemneController::class, 'destroy'])->name('solemnes.destroy'); // Cambiado a solemnes
Route::get('/solemnes/download/{fileName}', [SolemneController::class, 'download'])->name('solemnes.download'); // Cambiado a solemnes
Route::get('/solemnes/view/{fileName}', [SolemneController::class, 'view'])->name('solemnes.view'); // Cambiado a solemnes
Route::get('/solemnes/print/{fileName}', [SolemneController::class, 'print'])->name('solemnes.print'); // Cambiado a solemnes

use App\Http\Controllers\EspecialesController; // Cambiado a EspecialesController

Route::get('/especiales', [EspecialesController::class, 'index'])->name('especiales.index'); // Cambiado a especiales
Route::post('/especiales', [EspecialesController::class, 'store'])->name('especiales.store'); // Cambiado a especiales
Route::delete('/especiales/{fileName}', [EspecialesController::class, 'destroy'])->name('especiales.destroy'); // Cambiado a especiales
Route::get('/especiales/download/{fileName}', [EspecialesController::class, 'download'])->name('especiales.download'); // Cambiado a especiales
Route::get('/especiales/view/{fileName}', [EspecialesController::class, 'view'])->name('especiales.view'); // Cambiado a especiales
Route::get('/especiales/print/{fileName}', [EspecialesController::class, 'print'])->name('especiales.print'); // Cambiado a especiales

use App\Http\Controllers\ExpedienteController;

    Route::resource('expedientes', ExpedienteController::class);
    Route::get('/expedientes/{id}/pdf', [ExpedienteController::class, 'generatePDF'])->name('expedientes.generatePDF');
    Route::get('/expedientes/{id}/download', [ExpedienteController::class, 'download'])->name('expedientes.download');
    Route::get('/expediente/pdf/{id}', [ExpedienteController::class, 'generatePDF'])->name('expedientes.pdf');
    Route::post('/users/{id}/update-status', [UserController::class, 'updateStatus']);
    Route::get('/expedientes/ver/{id}', [ExpedienteController::class, 'ver'])->name('expedientes.ver');




use App\Http\Controllers\DocumentoController;

// Agrupamos las rutas relacionadas con documentos
Route::prefix('documentos')->group(function () {
    Route::get('/', [DocumentoController::class, 'index'])->name('documentos.index');
    Route::post('/importar', [DocumentoController::class, 'importar'])->name('documentos.importar');
    Route::delete('/{id}', [DocumentoController::class, 'eliminar'])->name('documentos.eliminar');
});

// Ruta para obtener documentos de un expediente específico
Route::get('/expedientes/{id}/documentos', [DocumentoController::class, 'obtenerDocumentos']);

// Ruta para filtrar documentos
Route::get('/documentos', [DocumentoController::class, 'filtrar'])->name('documentos.filtrar');
Route::get('/documentos/filter', [App\Http\Controllers\AcuerdoController::class, 'filter'])->name('documentos.filter');


use App\Http\Controllers\NewsController;
use App\Http\Controllers\VideoController;

Route::resource('news', NewsController::class);
Route::resource('videos', VideoController::class);
Route::get('api/videos', [VideoController::class, 'apiIndex']);


Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');




Route::get('/', [NewsController::class, 'welcome'])->name('welcome');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
Route::post('/news', [NewsController::class, 'store'])->name('news.store');

Route::get('/', [VideoController::class, 'welcome'])->name('welcome');
  

use App\Http\Controllers\RoleController;

Route::resource('roles', RoleController::class);
Route::post('roles/assign/{id}', [RoleController::class, 'assignRole'])->name('roles.assign');
Route::post('roles/remove/{id}', [RoleController::class, 'removeRole'])->name('roles.remove');






Route::get('requerimientos/crear', [RequerimientoController::class, 'create'])->name('requerimientos.create');


Route::post('requerimientos', [RequerimientoController::class, 'store'])->name('requerimientos.store');


Route::get('requerimientos/{requerimiento}/confirmar', [RequerimientoController::class, 'confirm'])->name('requerimientos.confirm');


Route::get('requerimientos/{requerimiento}/pdf', [RequerimientoController::class, 'pdf'])->name('requerimientos.pdf');




// 1. (Viene de Requerimientos) Muestra el formulario de crear orden, pre-llenado
Route::get('ordencompra/crear-desde/{requerimiento}', [OrdenCompraController::class, 'createFromRequerimiento'])->name('ordencompra.createFromRequerimiento');
Route::get('ordencompra/crear', [OrdenCompraController::class, 'create'])->name('ordencompra.create');
// 2. Guarda la nueva orden de pago
Route::post('ordencompra', [OrdenCompraController::class, 'store'])->name('ordencompra.store');

// 3. Página de confirmación (el nuevo paso)
Route::get('ordencompra/{ordenCompra}/confirmar', [OrdenCompraController::class, 'confirm'])->name('ordencompra.confirm');

// 4. Vista final para PDF y Imprimir
Route::get('ordencompra/{ordenCompra}/pdf', [OrdenCompraController::class, 'pdf'])->name('ordencompra.pdf');
// routes/web.php


// Esta es la ruta que llamará nuestro JavaScript
Route::post('/sugerencias/enviar', [SugerenciaController::class, 'enviarSugerenciaAjax'])->name('sugerencias.enviar');