<?php

namespace App\Http\Controllers;

use App\Models\company;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminAccess(){

        $companies = Company::paginate(10);;
        return view('company.index', compact('companies'));
    }
}
