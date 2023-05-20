<?php

namespace App\Http\Controllers;

use App\Custom\BreadcrumbItem;
use App\Models\Groupe;

class GroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Liste des groupes d'utilisateurs";
        $breadcrumbItems = [
            new BreadcrumbItem('Liste des groupes'),
        ];
        return view('app.groupe.index',compact('pageTitle','breadcrumbItems'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Groupe  $groupe
     * @return \Illuminate\Http\Response
     */
    public function show(Groupe $groupe)
    {
        $pageTitle = "Groupe d'utilisateur - $groupe->nom";
        $breadcrumbItems = [
            new BreadcrumbItem('Liste des groupes',route('app.groupe.index')),
            new BreadcrumbItem("$groupe->nom"),
        ];
        return view('app.groupe.show',compact('groupe','pageTitle','breadcrumbItems'));
    }
}