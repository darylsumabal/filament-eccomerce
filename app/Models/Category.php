<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\Attributes\Sluggable;

#[Fillable(['slug', 'name'])]
#[Sluggable(from: 'name', to: 'slug')]
class Category extends Model
{
    use SoftDeletes;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
