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

    /**
     * @OA\Get(
     *     tags={"Todo"},
     *     path="/api/todos",
     *     description="List of todo",
     *     @OA\Response(response="200", description="OK",
     *     content={
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     description="List of todo",
     *                     @OA\Items(type="object"),
     *                     example={
     *                      {
     *                          "uid": 1,
     *                          "id": 1,
     *                          "title": "delectus aut autem",
     *                          "completed": false,
     *                      }
     *                    } 
     *                 )
     *             )
     *         )
     *     }
     *  )
     * )
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

    /**
     * @OA\Get(
     *     tags={"Todo"},
     *     path="/api/todos/{id}",
     *     description="Get by id todo",
     *     @OA\Parameter(
     *         name="id",
     *         description="Todo ID",
     *         example = 1,
     *          in = "path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
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
     *                         description="Find todo by id"
     *                     ),
     *                     example={
     *                          "uid": 1,
     *                          "id": 1,
     *                          "title": "quis ut nam facilis et officia qui",
     *                          "completed": false,
     *                     }
     *                 )
     *             )
     *         }
     *      ),
     *  )
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

    /**
     * @OA\Post(
     *     tags={"Todo"},
     *     path="/api/todos",
     *     description="Create new todo",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Title hello world!"
     *                 ),
     *                 @OA\Property(
     *                     property="completed",
     *                     type="boolean",
     *                     example=false
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
     *                         description="Create new user"
     *                     ),
     *                     example={
     *                          "id": 201,
     *                          "title": "Title hello world!",
     *                          "completed": false,
     *                     }
     *                 )
     *             )
     *         }
     *      ),
     *  )
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

    /**
     * @OA\Put(
     *     tags={"Todo"},
     *     path="/api/todos/{id}",
     *     description="Update a todo",
     *     @OA\Parameter(
     *         name="id",
     *         description="Todo ID",
     *         example = 1,
     *          in = "path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ) 
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Update title hello world!"
     *                 ),
     *                 @OA\Property(
     *                     property="completed",
     *                     type="boolean",
     *                     example=true
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
     *                         description="Update a todo"
     *                     ),
     *                     example={
     *                          "uid": 1,
     *                          "id": 1,
     *                          "title": "Update Title hello world!",
     *                          "completed": false,
     *                     }
     *                 )
     *             )
     *         }
     *      ),
     *  )
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

    /**
     * @OA\Delete(
     *     tags={"Todo"},
     *     path="/api/todos/{id}",
     *     description="Delete a todo",
     *     @OA\Parameter(
     *         name="id",
     *         description="Todo ID",
     *         example = 1,
     *          in = "path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ) 
     *     ),
     *     @OA\Response(response="200", 
     *      description="OK"),
     *  )
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