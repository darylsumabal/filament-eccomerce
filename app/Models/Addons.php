<?php

namespace App\Models;

use Database\Factories\AddonsFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'price'])]
class Addons extends Model
{
    /** @use HasFactory<AddonsFactory> */
    use HasFactory, SoftDeletes;
}
