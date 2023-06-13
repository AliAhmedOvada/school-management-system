<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $users = User::where('id', auth()->id())->where('role_id', 1)->get();
        $teachers = User::where('id', auth()->id())->where('role_id', 2)->get();
        $students = User::where('id', auth()->id())->where('role_id', 3)->get();
        return view('home', compact('users','teachers','students'));
    }


    public function updateUser()
    {

    }
}
