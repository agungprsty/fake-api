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
        mixed $pagination = null,
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
        if ($pagination){
            $content['meta']['pagination'] = $pagination;
        }

        return response()->json($content, $status);
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
    public function all()
    {
        try {
            $qs = $this->check_query_string();
            $comment = $this->repo->all($qs);
            return $this->responses($comment, $qs);
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

    protected function check_query_string(): array
    {
        $result['page'] = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $result['per_page'] = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10;

        // Validation: Page to display can not be less than 1 or 
        // Request page greater than 100
        if ($result['page'] < 1 || $result['page'] > 100) {
            $result['page'] = 1;
        }

        // Validation: Request per page greater than 100
        if ($result['per_page'] > 100) {
            $result['per_page'] = 10;
        }

        return $result;
    }
}