<?php

namespace App\Http\Controllers\InventarioController;


use App\Http\Controllers\Controller;
use App\Http\Controllers\InventarioController\Services\CreateDetailsInventarioService;
use App\Http\Controllers\InventarioController\Services\CreateInventarioService;
use App\Http\Controllers\InventarioController\Services\CreateZonaService;
use App\Http\Controllers\InventarioController\Services\DeleteZonaService;
use App\Http\Controllers\InventarioController\Services\HistorialService;
use App\Http\Controllers\InventarioController\Services\SelectInventarioService;
use App\Http\Controllers\InventarioController\Services\ShowHistorialService;
use App\Http\Controllers\InventarioController\Services\UpdateZonaService;
use App\Http\Controllers\usersController\Services\AssignedPermissionsRoleService;
use App\Http\Controllers\usersController\Services\ChangeStateUserService;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\usersController\Services\RegisterUserService;
use App\Http\Controllers\usersController\Services\EditUserService;
use App\Http\Controllers\usersController\Services\ForgotPasswordService;
use App\Http\Controllers\usersController\Services\ListPermissionsRoleService;
use App\Http\Controllers\usersController\Services\LoginUserService;
use App\Http\Controllers\usersController\Services\RegisterUserPruebaService;
use App\Http\Controllers\usersController\Services\ResetPasswordService;
use App\Models\DetailInventario;
use App\Models\Inventario;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Zona;
use Carbon\Carbon;
use Illuminate\Validation\Rule;


class InventarioController extends Controller
{
   
    public function listInventario()
    {

        $inventario = Inventario::all();

        $inventario = $inventario->map(function ($invent) {
            
            return [
                'id'          => $invent->id,
                'name'        => $invent->name,
                'select'      => $invent->select,
                'date'        => Carbon::parse($invent->created_at)->format('Y-m-d'),
            ];
        });

        return response()->json(['status' => 'ok' ,'data' => $inventario, 'smg' => 'List Inventario']);
    }

    public function createInventario(Request $request)
    {
        return CreateInventarioService::store($request);
    }

    public function deleteInventario($id)
    {

        
        DetailInventario::where('inventario_id', $id)->delete();
        Inventario::destroy($id);

        return response()->json(['status' => 'ok' ,'smg' => 'eliminado']);

    }

    public function select($id)
    {
        return SelectInventarioService::select($id);
    }


    public function createDetailsInventario(Request $request)
    {
        return CreateDetailsInventarioService::details($request);
    }


    public function listZonas()
    {
        $zonas = Zona::all();

        return response()->json(['status' => 'ok' , 'smg' => 'Lista Zonas', 'data' => $zonas]);
    }


    public function listZonasPublic()
    {
        $zonas = Zona::where('state', 1)->get();

        $zonas = $zonas->map(function ($zona) {
          
                          
            return [
                'id'            => $zona->id,
                'name'          => $zona->name
            ];
        });

        return response()->json(['status' => 'ok' , 'smg' => 'Lista Zonas', 'data' => $zonas]);
    }


    public function createZona(Request $request)
    {
        return CreateZonaService::store($request);
    }

    public function updateZona(Request $request, $id)
    {
        return UpdateZonaService::update($request, $id);
    }

    public function deleteZona($id)
    {
        return DeleteZonaService::delete($id);
    }


    //listar productos contados
    public function historial()
    {
        return HistorialService::historial();
    }

    public function showHistorial($id)
    {
        return ShowHistorialService::historial($id);
    }





  
}
