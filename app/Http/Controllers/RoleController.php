<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles =Role::orderBy('created_at','DESC')->paginate(10);
        return view('roles.list',[
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions=Permission::OrderBy('name','DESC')->get();
        return view ('roles.create',[
            'permissions' =>  $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name'
        ]);

        if ($validator->passes()) {
            $role = Role::create(['name' => $request->name]);

            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }

            return redirect()->route('roles.index')->with('success', 'Roles Created Successfully');
        } else {
            return redirect()->route('roles.create')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $role = Role::findorFail($id);
            $permissions = Permission::OrderBy('name','DESC')->get();
            $hasPermission = $role->permissions->pluck('name');
            return view('roles.edit',[
                'role' => $role,
                'permissions' => $permissions,
                'hasPermission' => $hasPermission
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $role = Role::findOrFail($id);

        $validator = validator::make($request->all(),[
            'name' => 'required|unique:roles,name,'.$id.',id'
        ]);

        if($validator->passes()){

            $role->name=$request->name;
            $role->save();

            if (!empty($request->permission)) {
                  $role->syncPermissions($request->permission);
                }
              else{
                    $role->syncPermissions([]);
                }


            return redirect()->route('roles.index')->with('success', 'Roles Updated Successfully');
            }
            else{
                return redirect()->route('roles.edit',$id)->withInput()->withErrors($validator);

            }
        }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role=Role::findOrFail($id);
            $role->delete();
            return redirect()->route('roles.index')->with('delete');
    }
}
