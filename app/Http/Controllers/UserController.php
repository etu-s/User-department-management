<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Hash;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('departments')->get();

        return response()->json([
            'users' => $users
        ],200);
    }

    public function search(Request $request){

        $search = $request->get('s');
        if($search != null){
            $users = User::with('departments')
                            ->where('fullname','LIKE',"%$search%")
                            ->get();
            return response()->json([
                'users' => $users
            ],200);
        }else{
            return $this->index();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();

        return response()->json([

            'departments' => $departments
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|regex:/^[A-Za-zሀ-ፐ_]+$/|max:40',
            'email' => 'required|max:40',
            'password' => 'required|max:40',
            'department_id' => 'required',
        ], [
            'fullname.required' => ' full name is required.',
            'fullname.regex' => ' full name should be alphabate and under score only.',
            'email.required' => 'email is required.',
            'password.required' => 'password is required.',
            'department_id.required' => 'department is required.',
        ]);
        
        if ($validator->fails()) {
        
            return response()->json(['errors' => $validator->errors()->all()],400);
        }

        $password = Hash::make($request->password);
        
        $user = new User();

        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = $password;
        $user->save();

        $department = $request->department_id;
 
        $user->departments()->attach($department);
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
        $user = User::find($id);

        $departments = Department::all();

        return response()->json([
            'user' => $user,
            'department' => $user->departments->first()->id,
            'departments' => $departments
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|regex:/^[A-Za-zሀ-ፐ_]+$/|max:40',
            'email' => 'required|max:40',
            'password' => 'required|max:40',
            'department_id' => 'required',
        ], [
            'fullname.required' => ' full name is required.',
            'fullname.regex' => ' full name should be alphabate and under score only.',
            'email.required' => 'email is required.',
            'password.required' => 'password is required.',
            'department_id.required' => 'department is required.',
        ]);
        
        if ($validator->fails()) {
        
            return response()->json(['errors' => $validator->errors()->all()],400);
        }
        
        $user = User::find($id);

        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        $department = $request->department_id;
 
        $user->departments()->detach();
        $user->departments()->attach($department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->departments()->detach();
        $user->delete();
    }
}
