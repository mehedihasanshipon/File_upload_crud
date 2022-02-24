<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return Inertia::render('User/Index', [
            'users' => UserResource::collection($users)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('id', 'name', 'slug')->get();
        return Inertia::render('User/Create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        // Check if password was given 
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']) ;
        }
        // Store user in the database
        $user = User::create($data);

        return Redirect::route('admin.dashboard.index')->with('success', 'User Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $user = User::where('id',$user)->first();
        $roles = Role::select('id', 'name', 'slug')->get();
        return Inertia::render('User/Edit', [
            'roles' => $roles,
            'user' => new UserResource($user)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $user)
    {
        $user = User::where('id',$user)->first();
        $data = $request->validated();
        
        // Check if password was given 
        if ($data['password']) {
            $data['password'] = $data['password'] ? Hash::make($data['password']) : Hash::make($user->password) ;
        }else {
            $data['password'] = Hash::make($user->password);
        }
        // Update user in the database
        $user->update($data);

        return Redirect::route('admin.dashboard.index')->with('success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = User::where('id',$user)->first();
        $user->delete();
        return Redirect::back()->with('success', 'User Deleted');
    }
}
