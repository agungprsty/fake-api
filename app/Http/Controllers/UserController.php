<?php

namespace App\Http\Controllers;

use Throwable;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $repo;
    
    public function __construct(UserRepository $user)
    {
        $this->repo = $user;
    }

    /**
    * Wrap json response.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    protected function responses(
        mixed $data = null,
        int $status = 200,
    ){
        $content = [
            'meta' => [
                'status' => $status,
                'message' => Response::$statusTexts[$status]
            ],
        ];

        if ($data){
            $content['data'] = $data;
        }

        return response()->json($content, $status);
    } 

    /**
     * Get all user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        try {
            $user = $this->repo->all();
            return $this->responses($user);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Get by id user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_by_id(string $id)
    {
        try {
            $user = $this->repo->get_by_id($id);
            if (!(array)$user){
                return $this->responses([], '404');
            }

            return $this->responses($user);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Create new user
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $user = $this->repo->store($request);
            return $this->responses($user, 201);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Update user
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(string $id, Request $request)
    {
        try {
            $user = $this->repo->get_by_id($id);
            if (!(array)$user){
                return $this->responses([], '404');
            }

            $data = $this->repo->update($user, $request);
            return $this->responses($data);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(string $id)
    {
        try {
            $this->repo->get_by_id($id);
            return $this->responses();
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}