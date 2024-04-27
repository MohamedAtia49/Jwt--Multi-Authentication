<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index(){
        $owners = Owner::get();
        return response()->json($owners);
    }
    public function getCategories(){
        $categories = Category::select('id','name_' .app()->getLocale())->get();
        return response()->json($categories);
    }

    public function getUsers(){
        $users = User::get();
        return response()->json($users);
    }
}
