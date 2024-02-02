<?php

namespace App\Http\Controllers\usersController;


use App\Http\Controllers\Controller;
use App\Http\Controllers\usersController\Services\AssignedPermissionsRoleService;
use App\Http\Controllers\usersController\Services\ChangePasswordService;
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
use App\Http\Controllers\usersController\Services\UploadUserService;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
   

    public function index(){

        $users = User::with([
                    'roles' => function ($query) {
                        $query->select('name');
                    },
                    ])->get();

        $users = $users->map(function ($user) {
         
            // Agregar los nombres de las oficinas al campo "name"
            if ($user->roles->isNotEmpty()) {
                $rolesNames = $user->roles->pluck('name')->implode(', ');
                $user->rol .= '(' . $rolesNames . ')';
            }

            return [
                'id' => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'roles' => $user->rol,
                'state' => $user->state
            ];
        });

        return response()->json(['status' => 'ok' ,'data' => $users, 'smg' => 'Lista de usuarios']);
    }


    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:100',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8',
        ], [
            'name.required'     => 'Se requiere el name',
            'name.max'          => 'Maximo 100 caracteres',
            'email.required'    => 'Se requiere el email',
            'email.email'       => 'debe ser un correo electronico',
            'email.unique'      => 'Email esta en uso',
            'password.required' => 'Se requiere password',
            'password.min'      => 'minimo 8 caracteres',
        ]);
    
        if ($validator->fails()) {

            return response()->json(['status' => 'ok' ,'data' => $validator->errors(), 'smg' => 'Error de validacion']);
        
        }

        return RegisterUserService::store($request);
       
    }

    public function prueba(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:100',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8',
        ], [
            'name.required'     => 'Se requiere el name',
            'name.max'          => 'Maximo 100 caracteres',
            'email.required'    => 'Se requiere el email',
            'email.email'       => 'debe ser un correo electronico',
            'email.unique'      => 'Email esta en uso',
            'password.required' => 'Se requiere password',
            'email.required'    => 'minimo 8 caracteres',
        ]);
    
        if ($validator->fails()) {

            return response()->json(['status' => 'ko' ,'data' => $validator->errors(), 'smg' => 'Error de validacion']);
        
        }

        return RegisterUserPruebaService::store($request);
    }


    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:100',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
        ], [
            'name.required'     => 'Se requiere el name',
            'name.max'          => 'Maximo 100 caracteres',
            'email.required'    => 'Se requiere el email',
            'email.email'       => 'debe ser un correo electronico',
            'email.unique'      => 'Email esta en uso',
        ]);
    
        if ($validator->fails()) {

            return response()->json(['status' => 'ko' ,'data' => $validator->errors(), 'smg' => 'Error de validacion'], 422);
        
        }

        return EditUserService::update($request, $id);
       
    }

    public function login(Request $request){

        return LoginUserService::login($request);

    }

    public function forgot(Request $request){

        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|exists:users',
        ], [
            'email.required'    => 'Se requiere el email',
            'email.email'       => 'debe ser un correo electronico',
            'email.exists'      => 'Email no esta registrado',
        ]);
    
        if ($validator->fails()) {

            return response()->json(['status' => 'ok' ,'data' => $validator->errors(), 'smg' => 'Error de validacion']);
        
        }

        return ForgotPasswordService::forgot($request);

    }

    public function reset(Request $request){

        $validator = Validator::make($request->all(), [
            'password'     => 'required|min:8|max:15',
        ], [
            'password.required'     => 'Se requiere la contraseña',
            'password.min'          => 'debe tener minimo 8 caracteres',
            'password.max'          => 'debe tener minimo 15 caracteres',
        ]);
    
        if ($validator->fails()) {

            return response()->json(['status' => 'ok' ,'data' => $validator->errors(), 'smg' => 'Error de validacion']);
        
        }

        return ResetPasswordService::reset($request);

    }

    public function logout(){

        $user = auth::user();
        $user->tokens->each(function($token, $key){
            $token->delete();
        });

        return response()->json(['status' => 'ok' , 'smg' => 'usuario salio del sistema!']);
    }

    public function show(){

        $user = Auth::user();

        $user = User::findOrFail($user->id);
        $user->load(['roles']);

        $roles = $user->roles->pluck('name')->toArray();
        
        $permissions = $user->roles->flatMap->permissions->pluck('name')->unique()->toArray();

        // Agregar los nombres de las oficinas al campo "name"
        if ($user->roles->isNotEmpty()) {
            $rolesNames = $user->roles->pluck('name')->implode(', ');
            $user->rol .= '(' . $rolesNames . ')';
        }

        $data = [
            'id'  => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->rol,
         ];

         return response()->json(
            [
              'status'    => 'ok' ,
              'data'      => $data,
              'roles'     => $roles, 
              'permisos'  => $permissions, 
              'smg'       => 'Usuario'
            ]);

    }

    //subir foto de usuario
    public function upload(Request $request){

        return UploadUserService::upload($request);

    }

    public function changePassword(Request $request)
    {
        return ChangePasswordService::change($request);
    }

    public function changeState($id)
    {
        return ChangeStateUserService::changeState($id);
    }


    public function roles(){

        $role = Role::all();

        $role = $role->map(function ($rol) {

            return [
                'name'  => $rol->name,
            ];
        });

        return response()->json(['status' => 'ok' , 'data' => $role, 'smg' => 'Lista de roles']);
        
    }

    public function rolesConfig(){

        $role = Role::all();

        $role = $role->map(function ($rol) {

            return [
                'id'    => $rol->id,
                'name'  => $rol->name,
            ];
        });

        return response()->json(['status' => 'ok' , 'data' => $role, 'smg' => 'Lista de roles']);
        
    }

    public function permissions(){

        $role = Permission::orderBy('created_at', 'desc')->get();

        return response()->json(['status' => 'ok' , 'data' => $role, 'smg' => 'Lista de permisos']);
        
    }

    public function assignedPermissions($role_id, $permisions_id, $action)
    {   
        return AssignedPermissionsRoleService::assignedPermissions($role_id, $permisions_id, $action);
    }

    public function listPermissionsRole($id)
    {
        return ListPermissionsRoleService::listPermissions($id);
    }


  
}
