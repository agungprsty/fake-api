<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormRequest;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *   title="JSONFaker Documentation",
 *   description="JSONFaker Free Fake REST API",
 *   version="1.0.0",
 *   @OA\Contact(
 *     email="agungprsty423@gmail.com"
 *   ),
 *   @OA\License(
 *       name="Apache 2.0",
 *       url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *   )
 * )
 */

class Controller extends BaseController implements FormRequest
{
    protected $params;
    public $request;

    public function __contsruct(Request $request)
    {
        $this->params = $request->all();
        $this->request = $request;
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * @return \Illuminate\Http\Request
     */
    public function getParams()
    {
       return $this->request->replace($this->params);
    }
}
