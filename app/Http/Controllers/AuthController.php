<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Log;
use App\Repositories\AuthRepository;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    protected $authRepository;
    
    public function __construct(AuthRepository $authRepository)
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
        $this->authRepository = $authRepository;
    }
    
    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */

    /**
     * @OA\Post(
     *     tags={"Authentication"},
     *     path="/api/auth/login",
     *     description="Login",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="ujang@example.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     example="rahasia1234"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", 
     *      description="OK",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="object",
     *                         description="Credentials to login"
     *                     ),
     *                     example={
     *                          "access_token": "eyJ0eXAiOi.eyJpc3MiOiJodHRw.m3paLGqhKU0uFKEc--N0",
     *                          "token_type": "bearer",
     *                          "expires_in": "3600",
     *                     }
     *                 )
     *             )
     *         }
     *      ),
     *     @OA\Response(response="401", description="Incorrect email or password.")
     *  )
     */
    public function login(AuthRequest $request)
    {
        try {
            return $this->authRepository->login($request);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    /**
     * @OA\Post(
     *     tags={"Authentication"},
     *     path="/api/auth/refresh",
     *     description="Refresh token",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", 
     *      description="OK",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="object",
     *                         description="Credentials to login"
     *                     ),
     *                     example={
     *                          "access_token": "eyJ0eXAiOi.eyJpc3MiOiJodHRw.m3paLGqhKU0uFKEc--N0",
     *                          "token_type": "bearer",
     *                          "expires_in": "3600",
     *                     }
     *                 )
     *             )
     *         }
     *      ),
     *  )
     */
    public function refresh()
    {
        try {
            return $this->authRepository->refresh();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @OA\Post(
     *     tags={"Authentication"},
     *     path="/api/auth/logout",
     *     description="Logout",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", 
     *      description="OK",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="object",
     *                         description="Success to logout"
     *                     ),
     *                     example={"message" = "Successfully logged out"},
     *                 )
     *             )
     *         }
     *      ),
     *     @OA\Response(response="401", description="Unauthorized")
     *  )
     */
    public function logout()
    {
        try {
            return $this->authRepository->logout();
        } catch (JWTException $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'token_invalid'], 401);
        }
    }

    /**
     * Get detail user.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @OA\Get(
     *     tags={"Profile"},
     *     path="/api/profile/me",
     *     description="Get details profile",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", 
     *      description="OK",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="data",
     *                         type="object",
     *                         description="Details profile"
     *                     ),
     *                     example={
     *                          "id"=1,
     *                          "name"="Ujang Uyee",
     *                          "email"="ujang@example.com",
     *                          "role"="administrator",
     *                      },
     *                 )
     *             )
     *         }
     *      ),
     *     @OA\Response(response="401", description="You are not authorized")
     *  )
     */
    public function me()
    {
        try {
            return $this->authRepository->me();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}