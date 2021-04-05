<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Activity;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class UserController extends HomeProductController
{
    public function getUser($id)
    {
        return \response()->json(User::find($id));
    }

    public function rate(Request $request)
    {
        //with('comments','role','orders','orderDetails','ratings')->
        try {
            $user = User::find(session('user')->id);

            $query = $user->ratings()->where([
                'product_id'=>$request->idProduct,
                'user_id' => $user->id
            ]);
            if($query->exists()){
                $query->update(['grade'=>$request->rate]);

                DB::update("UPDATE products SET rate = (select sum(grade) from product_user where product_id = ?)/ (select count(*) from product_user where product_id = ?) WHERE id = ?",[$request->idProduct,$request->idProduct,$request->idProduct]);
                $userSession = User::with('comments','role','orders','orderDetails','ratings')->find(session('user')->id);

                session()->put('user',$userSession);

                return response()->json($user,Response::HTTP_OK);
            }
            $user->ratings()->attach($request->idProduct,['grade'=>$request->rate]);
            $userSession = User::with('comments','role','orders','orderDetails','ratings')->find(session('user')->id);
            session()->put('user',$userSession);
            return response()->json($user,Response::HTTP_OK);

        }
        catch (\PDOException $e)
        {
            Log::error($e->getMessage());
            return response()->json(['message'=>$e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function registerForm()
    {
        return view('pages.register',$this->data);
    }

    public function loginForm()
    {
        return view('pages.login',$this->data);
    }

    public function register(StoreUserRequest $request)
    {
        try
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = md5($request->password);
            $user->address = $request->address;
            $user->postal_code = $request->postal_code;
            $user->phone = $request->phone;
            $user->city = $request->city;
/*            $image = User::uploadImage($request->image);
            $user->image = $image;*/
            $user->role_id = 2;

            $user->save();

            if(session()->has('user') && session('user')->role_id == 1)
                return redirect()->back()->with('success', 'You successfully registered a user!');
            return redirect()->route('login.create')->with('success', 'You successfully registered, feel free to login!');
        }
        catch (\PDOException $e)
        {
            Log::error($e->getMessage());
            return redirect()->route('register.create')->with('error','There was an error registering your account, please try later!');
        }
    }


    public function login(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);

        try {
            //with('comments','role','orders','orderDetails','ratings')->
            $user = User::where([
                'email' => $email,
                'password' => $password
            ])->first();

            if($user)
            {
                $request->session()->put('user',$user);
                $idActivity = Activity::where('name','Login')->first()->id;
                $user->activities()->attach($idActivity,['date'=>date('Y-m-d H:i:s',time())]);
                if($user->role_id == 1)
                    return redirect()->route('admin');
                return redirect()->route('products');
            }

                return redirect()->route('login.create')->with('error','There is no user with these credentials!');

        }
        catch (\PDOException $e)
        {
            Log::error($e->getMessage());
            return redirect()->route('login.create')->with('error','There was an error logging you in, please try later!');
        }
    }

    public function logout()
    {
        $user = session('user');
        session()->remove('user');
        $idActivity = Activity::where('name','Logout')->first()->id;
        $user->activities()->attach($idActivity,['date'=>date('Y-m-d H:i:s',time())]);
        return redirect()->back();
    }

    public function edit()
    {
        try {
            if(session()->has('user'))
            {
                $this->data['user'] = User::with('role','orders','orderDetails','orderDetails.product')->find(session('user')->id);
                //$this->data['products'] = Order::with('orderDetails')->where('user_id',session('user')->id)->get();

                return view('pages.edit-profile',$this->data);
            }
            return redirect()->route('home');
        }catch (\Exception $e)
        {
            return redirect()->route('home')->with('error','We are resolving some issues, please be patient!');
        }

    }
}
