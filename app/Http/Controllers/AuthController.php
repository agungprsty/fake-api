<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Log;
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