<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\Attributes\Sluggable;

#[Fillable(['name', 'slug', 'description', 'price', 'category_id'])]
#[Sluggable(from: 'name', to: 'slug')]
class Product extends Model
{
    //
}
