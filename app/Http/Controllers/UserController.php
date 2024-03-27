<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::All();

        return view('users/index', compact('users'));
    }

    public function create(){
        $roles = Role::All();
        return view('users/create', compact('roles'));
    }

    public function store(Request $request)
    {  
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);
           
        $data = $request->all();
        // dd($data);
        $check = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' =>$data['role']
        ]);
         
        return redirect()->route('users.index')->withSuccess('Great! You have Successfully Add a User');
    }

    public function edit(User $user)
    {   
        $roles = Role::All();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'nullable|min:8',
            'role' => 'required',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)) $user->password = Hash::make($request->password);        
        $user->role_id = $request->role;    
        $user->save();    

        return redirect()->route('users.index')->withSuccess('Great! You have Successfully Updated a User'.$user->name);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('Success','user has been deleted successfully');
    }

}