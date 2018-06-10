<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User,App\Mission;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware(['admin','auth']);
  }

    public function index()
    {
      $user = User::where('is_admin','=',0)->get();
      $mission = Mission::all();
      return view('agents.index',['user' => $user,'mission' =>$mission]);
    }
}
