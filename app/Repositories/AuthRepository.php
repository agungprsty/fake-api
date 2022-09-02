<?php

namespace App\Repositories;

class AuthRepository extends BaseRepository
{
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
            'meta' => [
                'status' => 200,
                'message' => 'Successfully logged in'
            ],
            'data' => [
                'access_token' => $token,
            ]
        ]);
    }

    /**
     * Get a JWT via given credentials.
     * 
     * @param  Request  $request
     * @return Response
     */
    public function login()
    {
        $credentials = request()->only(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Incorrect email or password.'], 401);
        }

        return $this->respondWithToken($token);
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
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json([
            'meta' => [
                'status' => 200,
                'message' => 'OK'
            ],
            'data' => auth()->user()
        ]);
    }
}