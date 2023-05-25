<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Product extends Authenticatable
{
    use SoftDeletes;

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
    ];
}
