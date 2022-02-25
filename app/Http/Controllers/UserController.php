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
use Illuminate\Http\Request;
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
        $users = User::with('role')
        ->paginate(10)
        ->appends(request()->query());

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

    // User banned or Enable function
    public function disableUsers(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if($user->role->slug == 'admin') {
            return back()->with('error', 'Can not Disabled Admin User');
        }else{
            $user->update([
                'status' => $request->status,
            ]);
        }

        if ($user->status) {
            return back()->with('success', 'Enabled User');
        } else {
            return back()->with('error', 'Disabled User');
        }
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
        return Redirect::back()->with('error', 'User Deleted');
    }
}
