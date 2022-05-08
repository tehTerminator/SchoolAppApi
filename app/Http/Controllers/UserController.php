<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login($username, $password) {
        $user = User::where('username', $username)->first();

        if(empty($user)) {
            return response('User Not Found', 401);
        }

        if (Hash::check($user->password, $password)) {
            $token = $this->generateToken();
            $user->token = $token;
            $user->save();
            return response()->json($user);
        }

        return response('Invalid Password', 401);
    }

    public function register(Request $request) {
        $this->validate($request, [
            'username' => ['required', 'unique:users', 'alpha', 'max:50'],
            'password' => ['required', 'string'],
            'title' => ['required', 'string', 'max:100']
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'title' => $request->title
        ]);

        return response();
    }

    private function generateToken() {
        return bin2hex(random_bytes(32));
    }
}
