<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (! auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials'], 401);

        }
        $user        = Auth::user();
        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user'  => $user,
            'token' => $accessToken,
        ]);

    }

    public function register(Request $request)
    {

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:500',
        ]);

        $newUser           = new User();
        $newUser->name     = $request->name;
        $newUser->email    = $request->email;
        $newUser->password = bcrypt($request->password);
        $newUser->phone    = $request->phone;
        $newUser->address  = $request->address;
        $newUser->role_id  = 2;
        $newUser->status   = 0;

        $newUser->save();

        $token    = $newUser->createToken('authToken')->accessToken;
        $response = response([
            'user'  => $newUser,
            'token' => $token,
        ]);
        return $response;
    }
}
