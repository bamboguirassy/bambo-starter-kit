<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserGroupe extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the user that owns the UserGroupe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the groupe that owns the UserGroupe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function groupe(): BelongsTo
    {
        return $this->belongsTo(Groupe::class);
    }
}
