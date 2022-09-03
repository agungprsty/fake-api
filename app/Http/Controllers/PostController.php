<?php

namespace App\Http\Controllers;

use Throwable;
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    protected $repo;
    
    public function __construct(PostRepository $post)
    {
        $this->repo = $post;
    }

    /**
     * Get all post.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @OA\Get(
     *     tags={"Post"},
     *     path="/api/posts",
     *     description="List of post",
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
     *                     description="List of post",
     *                     @OA\Items(type="object"),
     *                     example={
     *                      {
     *                          "uid": 1,
     *                          "id": 1,
     *                          "title": "sunt aut facere repellat provident",
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
            $post = $this->repo->all($qs);
            return json_response($post, $qs);
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

    /**
     * @OA\Get(
     *     tags={"Post"},
     *     path="/api/posts/{id}",
     *     description="Get by id post",
     *     @OA\Parameter(
     *         name="id",
     *         description="Post ID",
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
     *                         description="Find post by id"
     *                     ),
     *                     example={
     *                          "uid": 1,
     *                          "id": 1,
     *                          "title": "sunt aut facere repellat provident",
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
            $post = $this->repo->get_by_id($id);
            if (!(array)$post){
                return json_response([], [], '404');
            }

            return json_response($post);
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

    /**
     * @OA\Post(
     *     tags={"Post"},
     *     path="/api/posts",
     *     description="Create new post",
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
     *                         description="Create new post"
     *                     ),
     *                     example={
     *                          "id": 101,
     *                          "title": "Title hello world!",
     *                          "body": "Body hello world!",
     *                     }
     *                 )
     *             )
     *         }
     *      ),
     *  )
     */
    public function store(PostRequest $request): JsonResponse
    {
        try {
            $post = $this->repo->store($request);
            return json_response($post, 201);
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

    /**
     * @OA\Put(
     *     tags={"Post"},
     *     path="/api/posts/{id}",
     *     description="Update a post",
     *     @OA\Parameter(
     *         name="id",
     *         description="Post ID",
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
     *                     property="body",
     *                     type="string",
     *                     example="Update Body Hello world!"
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
     *                         description="Create new post"
     *                     ),
     *                     example={
     *                          "uid": 1,
     *                          "id": 1,
     *                          "title": "Update Title hello world!",
     *                          "body": "Update Body hello world!",
     *                     }
     *                 )
     *             )
     *         }
     *      ),
     *  )
     */
    public function update(string $id, PostRequest $request): JsonResponse
    {
        try {
            $post = $this->repo->get_by_id($id);
            if (!(array)$post){
                return json_response([], [], '404');
            }

            $data = $this->repo->update($post, $request);
            return json_response($data);
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

    /**
     * @OA\Delete(
     *     tags={"Post"},
     *     path="/api/posts/{id}",
     *     description="Delete a post",
     *     @OA\Parameter(
     *         name="id",
     *         description="Post ID",
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

    /**
     * Get comments by ID posts
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @OA\Get(
     *     tags={"Post"},
     *     path="/api/posts/{id}/comments",
     *     description="Get comments by ID post",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID post",
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
     *                         type="array",
     *                         description="List comments by ID post",
     *                         @OA\Items(type="object"),
     *                         example={
     *                              {
     *                                  "post_id": 1,
     *                                  "id": 1,
     *                                  "name": "fajar cihuy",
     *                                  "email": "cihuy@example.com",
     *                                  "body": "quia et suscipit suscipit recusandae consequuntur expedita",
     *                              }
     *                         }
     *                     ),
     *                 )
     *             )
     *         }
     *      ),
     *  )
     */
    public function comments(string $id): JsonResponse
    {
        try {
            $comments = $this->repo->comments($id);
            if (!$comments){
                return json_response([], [], '404');
            }
            return json_response($comments);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}