<?php

namespace App\Custom;

use App\Models\GroupeRole;
use Illuminate\Support\Facades\Auth;

class AccessChecker
{
    private static $access = null;
    
    public static function getAccess() {
        if(static::$access==null) {
            static::$access = GroupeRole::whereEnabled(true)
            ->whereRelation('groupe.userGroupes', 'user_id', Auth::id())
            ->get()
            ->pluck('role.nom');
        }
        return static::$access;
    }

    public static function checkListingAccess($role_name)
    {
        if(Auth::check()) {
            if (Auth::user()->is_admin) {
                return true;
            }
            return static::getAccess()->contains("{$role_name}_list");
        }
        return false;
    }

    public static function checkEditingAccess($role_name)
    {
        if(Auth::check()) {
            if (Auth::user()->is_admin) {
                return true;
            }
            return static::getAccess()->contains("{$role_name}_edit");
        }
        return false;
    }

    public static function checkCreatingAccess($role_name)
    {
        if(Auth::check()) {
            if (Auth::user()->is_admin) {
                return true;
            }
            return static::getAccess()->contains("{$role_name}_new");
        }
        return false;
    }

    public static function checkShowingAccess($role_name)
    {
        if(Auth::check()) {
            if (Auth::user()->is_admin) {
                return true;
            }
            return static::getAccess()->contains("{$role_name}_show");
        }
        return false;
    }

    public static function checkDeletingAccess($role_name)
    {
        if(Auth::check()) {
            if (Auth::user()->is_admin) {
                return true;
            }
            return static::getAccess()->contains("{$role_name}_delete");
        }
        return false;
    }

    public static function checkFonctionnalityAccess($role_name)
    {
        if(Auth::check()) {
            if (Auth::user()->is_admin) {
                return true;
            }
            return static::getAccess()->contains("{$role_name}");
        }
        return false;
    }
    
}
