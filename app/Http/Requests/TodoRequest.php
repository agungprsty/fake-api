<?php

namespace App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TodoRequest extends Controller
{
   public function __construct(Request $request)
   {
      $this->validate(
         $request, [
            'title' => 'required|max:255',
            'completed' => 'required|boolean',
         ]
      );
   }
}