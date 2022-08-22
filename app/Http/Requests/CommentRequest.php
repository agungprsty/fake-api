<?php

namespace App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentRequest extends Controller
{
   public function __construct(Request $request)
   {
      $this->validate(
         $request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'body' => 'required',
         ]
      );
   }
}