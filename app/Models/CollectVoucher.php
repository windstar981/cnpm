<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Backpack\CRUD\app\Models\Traits\CrudTrait;

class CollectVoucher extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $guarded = [];

}
