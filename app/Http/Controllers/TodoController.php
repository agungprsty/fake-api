<?php

namespace App\Http\Controllers;

use Throwable;
use App\Http\Requests\TodoRequest;
use App\Repositories\TodoRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    protected $repo;
    
    public function __construct(TodoRepository $todo)
    {
        $this->repo = $todo;
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
     * Get all todo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        try {
            $todo = $this->repo->all();
            return $this->responses($todo);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Get by id todo.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_by_id(string $id)
    {
        try {
            $todo = $this->repo->get_by_id($id);
            if (!(array)$todo){
                return $this->responses([], '404');
            }

            return $this->responses($todo);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Create new todo
     *
     * @param  TodoRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TodoRequest $request)
    {
        try {
            $todo = $this->repo->store($request);
            return $this->responses($todo);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Update todo
     *
     * @param  TodoRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(string $id, TodoRequest $request)
    {
        try {
            $todo = $this->repo->get_by_id($id);
            if (!(array)$todo){
                return $this->responses([], '404');
            }

            $data = $this->repo->update($todo, $request);
            return $this->responses($data);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete todo
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