<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class EditProfile extends Controller
{
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = User::with('comments','role','orders','orderDetails','ratings')->find($id);
            $user->name = $request->name;
            if($user->email != $request->email)
            {
                $exists = User::where('email',$request->email)->exists();
                if($exists)
                    return redirect()->back()->with('error','There is already an user with that email!');
                $user->email = $request->email;
            }
            $user->address = $request->address;
            $user->city = $request->city;
            $user->phone = $request->phone;
            $user->postal_code = $request->postal_code;
            $user->save();

            session()->put('user',$user);
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
            $user = User::with('comments','role','orders','orderDetails','ratings')->find($id);
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

            session()->put('user',$user);
            return redirect()->back()->with('successPasswordChange','You have successfully changed your password!');
        }catch (\PDOException $e)
        {
            \Log::error($e->getMessage());
            return redirect()->back()->with('errorPasswordChange','There was an error changing your password!');
        }
    }
}
