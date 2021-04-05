<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends ParentAdminController
{

    public function edit()
    {
        $this->data['admin'] = User::with('role')->find(session('user')->id);
        return view('admin.examples.profile.edit',$this->data);
    }

    public function logout()
    {
        session()->remove('user');
        return redirect()->route('login.create')->with('message','Admin logged out');
    }


    /*public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->phone = $request->phone;
            $user->postal_code = $request->postal_code;
            $user->save();

            return redirect()->back()->with('success','You have successfully updated your account!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error','There was an error updating your account!');
        }
    }

    public function password(UpdatePasswordRequest $request,$id)
    {
        try {
            $user = User::find($id);
            if($user->password != md5($request->currentPassword))
            {
                return redirect()->back()->with('errorPasswordChange','Please provide a valid current password.');
            }
            if($request->newPassword != $request->confirmPassword)
            {
                return redirect()->back()->with('errorPasswordChange','The new password needs to match filed for confirmation.');
            }
            $user->password = md5($request->newPassword);
            $user->save();

            return redirect()->back()->with('successPasswordChange','You have successfully changed your password!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errorPasswordChange','There was an error changing your password!');
        }
    }*/

}
