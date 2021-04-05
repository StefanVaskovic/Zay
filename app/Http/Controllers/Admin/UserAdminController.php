<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAdminController extends ParentAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['users'] = User::with('role')->where('id','!=',session('user')->id)->paginate(6);
        return view('admin.examples.users.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('admin.examples.users.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->data['user'] = User::with('role')->find($id);
        $this->data['roles'] = Role::all();
        return view('admin.examples.users.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {


            $user = User::find($id);

            $user->name = $request->name;
            $user->role_id = $request->role;
            if($user->email != $request->email)
            {
                $exists = User::where('email',$request->email)->exists();
                if($exists)
                    return redirect()->back()->with('error','There is already an user with that email!');
                $user->email = $request->email;
            }
            $user->save();

            return redirect()->back()->with('success','You have successfully updated user!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','There was an error updating user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $count = DB::table('orders')->where('user_id',$id)->count();
            if($count)
                return redirect()->back()->with('error','There is user in order table, so you cannot delete it!');

            if(session('user')->id == $id)
                return redirect()->back()->with('error','You cannot delete your account!');

            User::destroy([$id]);
            return redirect()->back()->with('success','You have successfully deleted user!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','There was an error deleting user!');
        }
    }
}
