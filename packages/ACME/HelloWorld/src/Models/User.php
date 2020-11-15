<?php

namespace ACME\HelloWorld\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Product\Models\ProductProxy;
use ACME\HelloWorld\Contracts\User as UserContract;

class User extends Model implements UserContract
{
    protected $fillable = [];
}