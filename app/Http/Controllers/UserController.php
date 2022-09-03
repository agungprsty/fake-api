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
     * Get all user.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @OA\Get(
     *     tags={"User"},
     *     path="/api/users",
     *     description="List of user",
     *     security={{"bearerAuth": {}}},
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
     *                     description="List of user",
     *                     @OA\Items(type="object"),
     *                     example={
     *                      {
     *                          "id": 1,
     *                          "name": "Ujang Raharja",
     *                          "username": "Pehhh",
     *                          "email": "Ujanguyee@gmail.com",
     *                          "address": {
     *                               "street": "Kulas Light",
     *                               "suite": "Apt. 556",
     *                               "city": "Bandung",
     *                               "zipcode": "92998",
     *                               "geo": {
     *                                   "lat": "-37.3159",
     *                                   "lng": "81.1496"
     *                               },
     *                          },
     *                          "phone": "0897678542543",
     *                          "website": "aselole.com",
     *                          "company": {
     *                              "name": "PT Aselole Ceria",
     *                              "catchPhrase": "Multi-layered client-server neural-net",
     *                              "bs": "harness real-time e-markets"
     *                          }
     *                      }
     *                    } 
     *                 )
     *             )
     *         )
     *     }
     *   ),
     *   @OA\Response(response="401", description="You are not authorized")
     * )
     */
    public function all()
    {
        try {
            $qs = $this->check_query_string();
            $user = $this->repo->all($qs);
            return $this->responses($user, $qs);
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

    /**
     * @OA\Get(
     *     tags={"User"},
     *     path="/api/users/{id}",
     *     description="Get by id user",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         description="User ID",
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
     *                         description="Find user by id"
     *                     ),
     *                     example={
     *                          "id": 1,
     *                          "name": "Leanne Graham",
     *                          "username": "Bret",
     *                          "email": "Sincere@gmail.com",
     *                          "address": {
     *                               "street": "Kulas Light",
     *                               "suite": "Apt. 556",
     *                               "city": "Gwenborough",
     *                               "zipcode": "92998",
     *                               "geo": {
     *                                   "lat": "-37.3159",
     *                                   "lng": "81.1496"
     *                               },
     *                          },
     *                          "phone": "1-770-736-8031 x56442",
     *                          "website": "hildegard.org",
     *                          "company": {
     *                              "name": "Romaguera-Crona",
     *                              "catchPhrase": "Multi-layered client-server neural-net",
     *                              "bs": "harness real-time e-markets"
     *                          }
     *                      }
     *                 )
     *             )
     *         }
     *      ),
     *     @OA\Response(response="401", description="You are not authorized")
     *  )
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

    /**
     * @OA\Post(
     *     tags={"User"},
     *     path="/api/users",
     *     description="Create new user",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     example="Ujang Pramana"
     *                 ),
     *                 @OA\Property(
     *                     property="username",
     *                     type="string",
     *                     example="UjangUyee"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="ujanguyee@gmail.com"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="object",
     *                     @OA\Property(
     *                          property="street",
     *                          type="string",
     *                          example="Jl. Sudirman No. 56"
     *                     ),
     *                     @OA\Property(
     *                          property="suite",
     *                          type="string",
     *                          example="Apt. Kembang Jaya"
     *                     ),
     *                     @OA\Property(
     *                          property="city",
     *                          type="string",
     *                          example="Bandung"
     *                     ),
     *                     @OA\Property(
     *                          property="zipcode",
     *                          type="string",
     *                          example="12345"
     *                     ),
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string",
     *                     example="0897567532456"
     *                 ),
     *                 @OA\Property(
     *                     property="website",
     *                     type="string",
     *                     example="aselole.com"
     *                 ),
     *                 @OA\Property(
     *                     property="company",
     *                     type="object",
     *                     @OA\Property(
     *                          property="name",
     *                          type="string",
     *                          example="PT Aselole Jaya"
     *                     )
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
     *                         description="Create new users"
     *                     ),
     *                     example={
     *                          "id": 11,
     *                          "name": "Ujang Pramana",
     *                          "username": "UjangUyee",
     *                          "email": "ujanguyee@gmail.com",
     *                          "address": {
     *                               "street": "Jl.Sudirman No. 56",
     *                               "suite": "Apt. Kembang Jaya",
     *                               "city": "Bandung",
     *                               "zipcode": "12345"
     *                          },
     *                          "phone": "0897567532456",
     *                          "website": "aselole.com",
     *                          "company": {
     *                              "name": "PT Aselole Jaya"
     *                          }
     *                      }
     *                 )
     *             )
     *         }
     *      ),
     *     @OA\Response(response="401", description="You are not authorized")
     *  )
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

    /**
     * @OA\Put(
     *     tags={"User"},
     *     path="/api/users/{id}",
     *     description="Update a user",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         description="User ID",
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
     *                     example="Budi Pramana"
     *                 ),
     *                 @OA\Property(
     *                     property="username",
     *                     type="string",
     *                     example="BudiUyee"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     example="budiuyee@gmail.com"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="object",
     *                     @OA\Property(
     *                          property="street",
     *                          type="string",
     *                          example="Jl. Budi No. 06"
     *                     ),
     *                     @OA\Property(
     *                          property="suite",
     *                          type="string",
     *                          example="Apt. Kembang Jaya"
     *                     ),
     *                     @OA\Property(
     *                          property="city",
     *                          type="string",
     *                          example="Bandung"
     *                     ),
     *                     @OA\Property(
     *                          property="zipcode",
     *                          type="string",
     *                          example="12345"
     *                     ),
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string",
     *                     example="0897567532456"
     *                 ),
     *                 @OA\Property(
     *                     property="website",
     *                     type="string",
     *                     example="aselole.com"
     *                 ),
     *                 @OA\Property(
     *                     property="company",
     *                     type="object",
     *                     @OA\Property(
     *                          property="name",
     *                          type="string",
     *                          example="PT Aselole Jaya"
     *                     )
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
     *                         description="Update a users"
     *                     ),
     *                     example={
     *                          "id": 1,
     *                          "name": "Budi Pramana",
     *                          "username": "BudiUyee",
     *                          "email": "budiuyee@gmail.com",
     *                          "address": {
     *                               "street": "Jl. Budi No. 06",
     *                               "suite": "Apt. Kembang Jaya",
     *                               "city": "Bandung",
     *                               "zipcode": "12345"
     *                          },
     *                          "phone": "0897567532456",
     *                          "website": "aselole.com",
     *                          "company": {
     *                              "name": "PT Aselole Jaya"
     *                          }
     *                      }
     *                 )
     *             )
     *         }
     *      ),
     *     @OA\Response(response="401", description="You are not authorized")
     *  )
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

    /**
     * @OA\Delete(
     *     tags={"User"},
     *     path="/api/users/{id}",
     *     description="Delete a user",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         description="User ID",
     *         example = 1,
     *          in = "path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ) 
     *     ),
     *     @OA\Response(response="200", 
     *      description="OK"
     *     ),
     *     @OA\Response(response="401", description="You are not authorized")
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