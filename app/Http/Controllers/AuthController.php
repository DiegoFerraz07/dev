<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserLoginFormRequest;
use App\Http\Requests\Users\UsersAddFormRequest;
use App\Http\Resources\UserAuthResources;
use App\Http\Resources\UserLoginResources;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(UsersAddFormRequest $request, UsersRepository $userRepository)
    {
    
        $user = $userRepository->store($request);
        //$token = auth()->attempt(['email'=>$request->email, 'password'=>$request->password]);

        return new UserAuthResources(
            [
                'saved' => [
                    'success' => true,
                    'user' => $user,
                    'message' => 'User created',
                    //'token' => $token
                ]
            ]
        );
    }

    public function login(UserLoginFormRequest $request, UsersRepository $usersRepository)
    {   
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = $usersRepository->getByEmail($request->email);
        return $this->respondWithToken($token, $user);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token,$user)
    {
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 3660
        ]);
    }

}
