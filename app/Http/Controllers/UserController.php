<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\DataTables\UsersDataTable;
use App\Models\UbicacionFisica;

class UserController extends Controller
{

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index','show']]);
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        
        return view('users.create', [
            'roles' => Role::pluck('name')->all(),
            'ubicacion_fisicas' => UbicacionFisica::pluck('ubicacion_fisica', 'id')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        $user = User::create($input);
        $user->assignRole($request->roles);

        return redirect()->route('users.index')
                ->withSuccess('Nuevo usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        /* return User::all();
        dd($user->ubicacionFisicaName()); */
        return view('users.show', [
            'user' => $user,
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $user->roles->pluck('name')->all(),
            'ubicacion_fisicas' => UbicacionFisica::pluck('ubicacion_fisica')->all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Check Only Super Admin can update his own Profile
        if ($user->hasRole('Super Admin')){
            if($user->id != auth()->user()->id){
                abort(403, 'EL USUARIO NO TIENE PERMISOS SUFICIENTES PARA REALIZAR ESTA ACCIÓN');
            }
        }
        
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $user->roles->pluck('name')->all(),
            'ubicacion_fisicas' => UbicacionFisica::select('id', 'ubicacion_fisica')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {

        if(!empty($request->password)){
            $input['password'] = Hash::make($request->password);
        }else{
            $input = $request->except('password');
        }
        
        $user->update($input);

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')
                ->withSuccess('Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // About if user is Super Admin or User ID belongs to Auth User
        if ($user->hasRole('Super Admin') || $user->id == auth()->user()->id)
        {
            return response()->json([
                'success' => false,
                'message' => 'No se puede eliminar este usuario.',
                'details' => 'No tiene permisos suficientes para eliminar un Super Admin o tu propio usuario.',
                'code' => 'FORBIDDEN'
            ], 403);
        }

        try {
            $user->syncRoles([]);
            $user->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Usuario eliminado exitosamente.',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el usuario.',
                'details' => $e->getMessage(),
                'code' => 'ERROR'
            ], 500);
        }
    }

}
