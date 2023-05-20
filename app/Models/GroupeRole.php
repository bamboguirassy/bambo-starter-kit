<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupeRole extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the role that owns the GroupeRole
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the groupe that owns the GroupeRole
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function groupe(): BelongsTo
    {
        return $this->belongsTo(Groupe::class);
    }
}
