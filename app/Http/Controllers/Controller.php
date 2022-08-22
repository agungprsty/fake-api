<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormRequest;
use Laravel\Lumen\Routing\Controller as BaseController;

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
