<?php

namespace App\Http\Controllers;

use App\Custom\BreadcrumbItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "Liste des utilisateurs";
        $breadcrumbItems = [
            new BreadcrumbItem('Liste des utilisateurs'),
        ];
        return view('app.user.index',compact('pageTitle','breadcrumbItems'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $pageTitle = "Détails utilisateur - {$user->name}";
        $breadcrumbItems = [
            new BreadcrumbItem('Liste des utilisateurs',route('app.user.index')),
            new BreadcrumbItem("{$user->name}"),
        ];
        return view('app.user.show',compact('user','pageTitle','breadcrumbItems'));
    }

    public function showProfil() {
        $pageTitle = "Mon profil - ".Auth::user()->name;
        $breadcrumbItems = [
            new BreadcrumbItem(Auth::user()->name),
        ];
        return view('app.user.user-profil',compact('pageTitle','breadcrumbItems'));
    }
}