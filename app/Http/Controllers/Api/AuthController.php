<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\User;

class AuthController extends Controller
{
  /**
   * Get a JWT via given credentials.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request)
  {
    $credentials = $request->only(['email', 'password']);

    if (!$token = auth('api')->attempt($credentials)) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
  }

  /**
   * Log the user out (Invalidate the token).
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function logout()
  {
    auth('api')->logout();

    return response()->json(['message' => 'Successfully logged out']);
  }
  
  /**
   * Get the authenticated User.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function me()
  {
    return response()->json(auth('api')->user());
  }

  /**
   * Refresh a token.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function refresh()
  {
    return $this->respondWithToken(auth('api')->refresh());
  }

  public function register(UserRegisterRequest $request)
  {
    
    $user = User::create(array_merge(
      $request->validated(),
      ['password' => Hash::make($request->validated()['password'])]
    ));

    if(!$user) {
      return response()->json(['error' => 'Something is wrong, try again later'], 401);
    }

    $this->registered($user);
    $credentials = $request->only(['email', 'password']);
    
    if (!$token = auth('api')->attempt($credentials)) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
  }

  /**
   * Get the token array structure.
   *
   * @param  string $token
   *
   * @return \Illuminate\Http\JsonResponse
   */
  protected function respondWithToken($token)
  {
      return response()->json([
          'token' => $token,
          'token_type' => 'bearer',
          'expires_in' => auth('api')->factory()->getTTL() * 60
      ]);
  }

  protected function registered($user)
  {
    Mail::to($user->email)->send(new UserRegisteredEmail($user));
  }
}
