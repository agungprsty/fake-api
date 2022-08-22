<?php

namespace App\Http\Controllers;

use Throwable;
use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    protected $repo;
    
    public function __construct(CommentRepository $comment)
    {
        $this->repo = $comment;
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
     * Get all comment.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        try {
            $comment = $this->repo->all();
            return $this->responses($comment);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Get by id comment.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_by_id(string $id)
    {
        try {
            $comment = $this->repo->get_by_id($id);
            if (!(array)$comment){
                return $this->responses([], '404');
            }

            return $this->responses($comment);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Create new comment
     *
     * @param  CommentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CommentRequest $request)
    {
        try {
            $comment = $this->repo->store($request);
            return $this->responses($comment, 201);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Update comment
     *
     * @param  CommentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(string $id, CommentRequest $request)
    {
        try {
            $comment = $this->repo->get_by_id($id);
            if (!(array)$comment){
                return $this->responses([], '404');
            }

            $data = $this->repo->update($comment, $request);
            return $this->responses($data);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete comment
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