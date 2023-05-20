<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Groupe extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot() {
        parent::boot();

        static::deleting(function($groupe) {
            $groupe->groupeRoles()->delete();
        });

        static::created(function($groupe) {
            $roles = Role::all();
            foreach ($roles as $role) {
                $groupeRole = new GroupeRole(['groupe_id'=>$groupe->id,'role_id'=>$role->id]);
                $groupe->groupeRoles()->save($groupeRole);
            }
        });
    }

    /**
     * Get all of the groupeRoles for the Groupe
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groupeRoles(): HasMany
    {
        return $this->hasMany(GroupeRole::class);
    }

    /**
     * Get all of the userGroupes for the Groupe
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userGroupes(): HasMany
    {
        return $this->hasMany(UserGroupe::class);
    }

}
