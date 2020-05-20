<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getUsers(){
        return view('backend.users.users');
    }

    public function getUsersAdd(){
        return view('backend.users.user-add');
    }

    public function getUsersEdit(){
        return view('backend.users.user-edit');
    }
}
