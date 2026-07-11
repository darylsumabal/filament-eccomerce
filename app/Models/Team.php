<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\Attributes\Sluggable;

#[Fillable(['name', 'slug'])]
#[Sluggable(from: 'name', to: 'slug')]
class Team extends Model
{
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
