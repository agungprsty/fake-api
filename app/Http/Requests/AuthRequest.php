<?php

namespace App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthRequest extends Controller
{
   public function __construct(Request $request)
   {
      $this->validate(
         $request, [
            'email' => 'required|email',
            'password' => 'required'
         ]
      );
   }
}