<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasApiTokens, HasFactory, Notifiable, SendsPasswordResetEmails;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'enabled'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot() {
        parent::boot();
        static::deleting(function($user) {
            $user->userGroupes()->delete();
        });
        self::created(function (User $user) {
            $request = new Request();
            $request->replace(['email'=>$user->email]);
            $user->sendResetLinkEmail($request);
        });
    }

    /**
     * The groupes that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groupes(): BelongsToMany
    {
        return $this->belongsToMany(Groupe::class,'user_groupes');
    }

    /**
     * Get all of the userGroupes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userGroupes(): HasMany
    {
        return $this->hasMany(UserGroupe::class);
    }

    public function getIsAdminAttribute() {
        return $this->role == 'admin';
    }
}
