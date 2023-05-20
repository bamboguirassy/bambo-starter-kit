<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot() {
        parent::boot();
        self::created(function($role) {
            $groupes = Groupe::all();
            foreach ($groupes as $groupe) {
                $role->groupeRoles()->save(new GroupeRole(['groupe_id'=>$groupe->id]));
            }
        });
    }

    /**
     * Get all of the groupeRoles for the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groupeRoles(): HasMany
    {
        return $this->hasMany(GroupeRole::class);
    }
}
