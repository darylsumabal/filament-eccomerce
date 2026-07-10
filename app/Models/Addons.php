<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'price'])]
class Addons extends Model
{
    /** @use HasFactory<\Database\Factories\AddonsFactory> */
    use HasFactory, SoftDeletes;
}
