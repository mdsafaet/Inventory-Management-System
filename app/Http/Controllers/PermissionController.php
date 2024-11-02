<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::orderBy('created_at','DESC')->paginate(10);
        return view ('permissions.list',[
             'permissions' =>  $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),
        [
            'name'=>'required|unique:permissions,name'
        ]);
               
        if($validator->passes()){
            Permission::create([      
             'name'=> $request->name]);

             return redirect()->route('permissions.index')->with('success', 'Permission Created Successfully');

            }

        else{

            return redirect()->route('permissions.create')->withInput()->withErrors($validator);

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
        $permission = Permission::findOrFail($id);

        return view('permissions.edit',[
            'permission'=>$permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
   
    {
        $permission = Permission::findOrFail($id);
        $validator = Validator::make($request->all(),
        [
            'name'=>'required|unique:permissions,name, '.$id.',id'
        ]);
               
        if($validator->passes()){
           

            $permission->name= $request->name;
            $permission->save();

             return redirect()->route('permissions.index')->with('success', 'Permission Updated Successfully');

            }

        else{

            return redirect()->route('permissions.edit,$id')->withInput()->withErrors($validator);

            }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
                $permission=Permission::findOrFail($id);
                $permission->delete();
                return redirect()->route('permissions.index')->with('success', 'Permission Deleted Successfully');
    }
}
