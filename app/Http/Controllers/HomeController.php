<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    //

    public function index(){
        return view('home.userpage');
    }
    public function redirect(){
        $userType = Auth::user()->usertype; 
        if($userType=='1'){
            return view('admin.home');
        }
        else{
            return view('home.userpage');
        }
    }

   
}
