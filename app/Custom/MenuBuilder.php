<?php

namespace App\Custom;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class MenuBuilder
{
    public static function buildMenu()
    {
        $menus = [
            [
                'label' => 'Tableau de bord', 'icon' => 'bi bi-grid',
                'route' => route('app.home'), 'id' => null,
                'children' => [], 'active' => Route::currentRouteName()=='app.home', 'visible' => AccessChecker::checkFonctionnalityAccess('dashboard')
            ],
            [
                'label' => 'Gestion des utilisateurs', 'icon' => null,
                'route' => null, 'id' => 'gestion-admin', 'visible' => false,
                'children' => collect([
                    ['label' => 'Groupes', 'icon' => 'bi bi-circle', 'route' => route('app.groupe.index'), 'model' => 'groupe', 'visible' => AccessChecker::checkListingAccess('groupe'),'active' => Route::currentRouteName()=='app.groupe.index'],
                    ['label' => 'Fonctionnalités', 'icon' => 'bi bi-people', 'route' => route('app.role.index'), 'model' => 'role', 'visible' => AccessChecker::checkListingAccess('role'),'active' => Route::currentRouteName()=='app.role.index'],
                    ['label' => 'Utilisateurs', 'icon' => 'bi bi-people', 'route' => route('app.user.index'), 'model' => 'user', 'visible' => AccessChecker::checkListingAccess('user'),'active' => Route::currentRouteName()=='app.user.index'],
                ]), 'active' => false
            ],
        ];
        // filtrer le menu pour enlever les menus invisibles
        foreach ($menus as $index=>$menu) {
            if(count($menu['children'])) {
                $menus[$index]['visible'] = $menu['children']->pluck('visible')->contains(true);
                $menus[$index]['active'] = $menu['children']->pluck('active')->contains(true);
            }
        }
        // dd(AccessChecker::checkListingAccess('client'));
        // dd($menus);
        return $menus;
    }
}
