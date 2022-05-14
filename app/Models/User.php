<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasFactory;
    use HasRoles; // <------ and this
    use CrudTrait;
    protected $guarded = [];
    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
}
