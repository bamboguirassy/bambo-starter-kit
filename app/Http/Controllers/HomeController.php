<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use App\Models\Client;
use App\Models\Competence;
use App\Models\Employe;
use App\Models\Sexe;
use App\Models\TypeContrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        $pageTitle = "Tableau de bord";
        $breadcrumbItems = [];


        return view('home', compact(
            'pageTitle',
            'breadcrumbItems',
        ));
    }
}
