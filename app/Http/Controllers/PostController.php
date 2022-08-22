<?php

namespace App\Http\Controllers;

use Throwable;
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class PostController extends Controller
{
    protected $repo;
    
    public function __construct(PostRepository $post)
    {
        $this->repo = $post;
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
     * Get all post.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        try {
            $post = $this->repo->all();
            return $this->responses($post);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Get by id post.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_by_id(string $id)
    {
        try {
            $post = $this->repo->get_by_id($id);
            if (!(array)$post){
                return $this->responses([], '404');
            }

            return $this->responses($post);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Create new post
     *
     * @param  PostRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostRequest $request)
    {
        try {
            $post = $this->repo->store($request);
            return $this->responses($post, 201);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Update post
     *
     * @param  PostRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(string $id, PostRequest $request)
    {
        try {
            $post = $this->repo->get_by_id($id);
            if (!(array)$post){
                return $this->responses([], '404');
            }

            $data = $this->repo->update($post, $request);
            return $this->responses($data);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete post
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