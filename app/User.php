<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use SoftDeletes;
    protected $guarded = [];
}
