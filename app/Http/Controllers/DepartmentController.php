<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();

        return response()->json([
            'departments' => $departments
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[A-Za-zሀ-ፐ_]+$/|max:40',
        ], [
            'name.required' => ' department name is required.',
            'name.regex' => ' department name should be alphabate and under score only.',
        ]);
        
        if ($validator->fails()) {
        
            return response()->json(['errors' => $validator->errors()->all()],400);
        }
        
        $department = new Department();

        $department->name = $request->name;
        $department->save();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::find($id);

        return response()->json([
            'department' => $department
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[A-Za-zሀ-ፐ_]+$/|max:40',
        ], [
            'name.required' => ' department name is required.',
            'name.regex' => ' department name should be alphabate and under score only.',
        ]);
        
        if ($validator->fails()) {
        
            return response()->json(['errors' => $validator->errors()->all()],400);
        }
        
        $department = Department::find($id);

        $department->name = $request->name;
        $department->save();
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        $department->users()->detach();
        $department->delete();
    }
}
