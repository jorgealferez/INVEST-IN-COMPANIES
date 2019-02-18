<?php

namespace App\Http\Controllers;

use App\Provincia;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $provincias=Provincia::all();
        return view('public.home')
        ->with(
            compact(
            'provincias'
            )
        );
    }
}
