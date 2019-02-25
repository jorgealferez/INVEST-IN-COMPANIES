<?php

namespace App\Http\Controllers\Dashboard;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\EditAsociacionRequest;
use App\Http\Controllers\DashBoardController;

class BoardController extends  DashBoardController
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        Parent::RolesCheck();
        return view('dashboard.dashboard');
    }



}
