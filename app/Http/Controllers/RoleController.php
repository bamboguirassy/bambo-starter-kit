<?php

namespace App\Http\Controllers;

use App\Custom\BreadcrumbItem;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Liste des fonctionnalités à protéger";
        $breadcrumbItems = [
            new BreadcrumbItem('Liste des fonctionnalités à protéger'),
        ];
        return view('app.role.index',compact('pageTitle','breadcrumbItems'));
    }
}