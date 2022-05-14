<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $guarded = [];

}
