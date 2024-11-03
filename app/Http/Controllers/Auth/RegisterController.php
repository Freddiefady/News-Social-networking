<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'=> 'required', 'string', 'max:255',
            'username'=> 'required| string | max:50 | unique:users',
            'email'=> 'required', 'string', 'email', 'max:255', 'unique:users',
            'image'=> 'nullable | image | mimes:jpeg,png,jpg,gif | max:2048',
            'country'=> 'nullable | string | max:50',
            'city'=> 'nullable | string | max:50',
            'street'=> 'nullable | string | max:50',
            'phone'=> 'required | max:15 | unique:users',
            'password'=> 'required', 'string', 'min:8', 'confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $register = User::create([
            'name'=>$data['name'],
            'username'=>$data['username'],
            'email'=>$data['email'],
            'image'=>$data['image'],
            'country'=>$data['country'],
            'city'=>$data['city'],
            'street'=>$data['street'],
            'phone'=>$data['phone'],
            'password' => Hash::make($data['password']),
        ]);
        if($data['image'])
        {
            $image = $data['image'];
            $imageName = Str::slug($register->username).time().$image->getClientOriginalExtension(); // <img scr="{{ asset('uploads/users'.auth()->user()->image) }}" best performance
            $path = $image->storeAs('uploads/users', $imageName, ['disk'=>'uploads']);

            $register->update([
                'image' => $path,
            ]);
        }

        return $register;
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }
        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }
    protected function registered(Request $request, $user)
    {
        Session::flash('success', 'registered successfully');
        return redirect()->route('frontend.index');
    }
}

