<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxPagination(Request $request)
    {
        $data = Item::paginate(5);

        if ($request->ajax()) {
            return view('presult', compact('data'));
        }

        return view('ajaxPagination', compact('data'));
    }
}
