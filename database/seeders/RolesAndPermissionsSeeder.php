<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Crear roles si no existen
        $roleEmpleado = Role::firstOrCreate(['name' => 'empleado']);
        echo "Rol empleado creado: {$roleEmpleado->id}\n";
    
        $roleAdministrador = Role::firstOrCreate(['name' => 'administrador']);
        echo "Rol administrador creado: {$roleAdministrador->id}\n";
    
        $roleSuperadministrador = Role::firstOrCreate(['name' => 'superadministrador']);
        echo "Rol superadministrador creado: {$roleSuperadministrador->id}\n";
    
        // Crear permisos si no existen
        $permissionView = Permission::firstOrCreate(['name' => 'view articles']);
        echo "Permiso 'view articles' creado: {$permissionView->id}\n";
    
        $permissionPrint = Permission::firstOrCreate(['name' => 'print articles']);
        echo "Permiso 'print articles' creado: {$permissionPrint->id}\n";
    
        $permissionDownload = Permission::firstOrCreate(['name' => 'download articles']);
        echo "Permiso 'download articles' creado: {$permissionDownload->id}\n";
    
        $permissionDelete = Permission::firstOrCreate(['name' => 'delete articles']);
        echo "Permiso 'delete articles' creado: {$permissionDelete->id}\n";
    
        // Asignar permisos a roles
        $roleEmpleado->syncPermissions([$permissionView, $permissionPrint, $permissionDownload]);
        echo "Permisos asignados al rol empleado\n";
    
        $roleAdministrador->syncPermissions([$permissionView, $permissionPrint, $permissionDownload]);
        echo "Permisos asignados al rol administrador\n";
    
        $roleSuperadministrador->syncPermissions([$permissionView, $permissionPrint, $permissionDownload, $permissionDelete]);
        echo "Permisos asignados al rol superadministrador\n";
    
        // Verificar si el superadministrador ya existe
        $superAdmin = User::where('email', 'super@gmail.com')->first();
    
        if (!$superAdmin) {
            // Crear el superadministrador
            $superAdmin = User::create(
                [
                    'email' => 'concejo@gmail.com',
                    'name' => 'Super',
                    'apellido' => 'Usuario',
                    'nivel_de_acceso' => 'superadministrador',
                    'password' => ('Papel123#$'),
                    'protected' => true // Añadir este campo
                ]
            );
            echo "Superadministrador creado: {$superAdmin->id}\n";
    
            // Asignar el rol de superadministrador
            $superAdmin->assignRole('superadministrador');
            echo "Rol de superadministrador asignado al usuario\n";
        } else {
            echo "El superadministrador ya existe: {$superAdmin->id}\n";
        }
    }
}
