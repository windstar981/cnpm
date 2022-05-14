<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Attribute extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $guarded = [];

}
