<?php

namespace App\Http\Controllers;

use Throwable;
use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    protected $repo;
    
    public function __construct(CommentRepository $comment)
    {
        $this->repo = $comment;
    }

    /**
     * Get all comment.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @OA\Get(
     *     tags={"Comment"},
     *     path="/api/comments",
     *     description="List of Comment",
     *     @OA\Parameter(
     *         name="page",
     *         description="Params page",
     *         example = 1,
     *          in = "query",
     *         @OA\Schema(
     *             type="integer"
     *         ) 
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         description="Params per page",
     *         example = 10,
     *          in = "query",
     *         @OA\Schema(
     *             type="integer"
     *         ) 
     *     ),
     *     @OA\Response(response="200", description="OK",
     *     content={
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     description="List of comment",
     *                     @OA\Items(type="object"),
     *                     example={
     *                      {
     *                          "post_id": 1,
     *                          "id": 1,
     *                          "name": "sunt aut facere repellat provident",
     *                          "email": "Eliseo@gardner.biz",
     *                          "body": "quia et suscipit suscipit recusandae consequuntur expedita",
     *                      }
     *                    } 
     *                 )
     *             )
     *         )
     *     }
     *  )
     * )
     */
    public function all(): JsonResponse
    {
        try {
            $qs = check_query_string();
            $comment = $this->repo->all($qs);
            return json_response($comment, $qs);
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

    /**
     * @OA\Get(
     *     tags={"Comment"},
     *     path="/api/comments/{id}",
     *     description="Get by id comment",
     *     @OA\Parameter(
     *         name="id",
     *         description="Comment ID",
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
     *                         description="Find comment by id"
     *                     ),
     *                     example={
     *                          "post_id": 1,
     *                          "id": 1,
     *                          "name": "sunt aut facere repellat provident",
     *                          "email": "Eliseo@gardner.biz",
     *                          "body": "quia et suscipit suscipit recusandae consequuntur expedita",
     *                     }
     *                 )
     *             )
     *         }
     *      ),
     *  )
     */
    public function get_by_id(string $id): JsonResponse
    {
        try {
            $comment = $this->repo->get_by_id($id);
            if (!(array)$comment){
                return json_response([], '404');
            }

            return json_response($comment);
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

    /**
     * @OA\Post(
     *     tags={"Comment"},
     *     path="/api/comments",
     *     description="Create new comment",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="Hello world!"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="hello@gmail.com"
     *                 ),
     *                 @OA\Property(
     *                     property="body",
     *                     type="string",
     *                     example="Body Hello world!"
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
     *                         description="Create new comment"
     *                     ),
     *                     example={
     *                          "id": 501,
     *                          "name": "Hello world!",
     *                          "email": "hello@gmail.com",
     *                          "body": "Body Hello world!",
     *                     }
     *                 )
     *             )
     *         }
     *      ),
     *  )
     */
    public function store(CommentRequest $request): JsonResponse
    {
        try {
            $comment = $this->repo->store($request);
            return json_response($comment, 201);
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

    /**
     * @OA\Put(
     *     tags={"Comment"},
     *     path="/api/comment/{id}",
     *     description="Update a comment",
     *     @OA\Parameter(
     *         name="id",
     *         description="Comment ID",
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
     *                     property="name",
     *                     type="string",
     *                     example="Update hello world!"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="helloupdate@gmail.com"
     *                 ),
     *                 @OA\Property(
     *                     property="body",
     *                     type="string",
     *                     example="Update body Hello world!"
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
     *                         description="Update a comment"
     *                     ),
     *                     example={
     *                          "post_id": 1,
     *                          "id": 1,
     *                          "name": "Update hello world!",
     *                          "email": "helloupdate@gmail.com",
     *                          "body": "Update body hello world!",
     *                     }
     *                 )
     *             )
     *         }
     *      ),
     *  )
     */
    public function update(string $id, CommentRequest $request): JsonResponse
    {
        try {
            $comment = $this->repo->get_by_id($id);
            if (!(array)$comment){
                return json_response([], '404');
            }

            $data = $this->repo->update($comment, $request);
            return json_response($data);
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

    /**
     * @OA\Delete(
     *     tags={"Comment"},
     *     path="/api/commets/{id}",
     *     description="Delete a comment",
     *     @OA\Parameter(
     *         name="id",
     *         description="Comment ID",
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
    public function delete(string $id): JsonResponse
    {
        try {
            $this->repo->get_by_id($id);
            return json_response();
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}