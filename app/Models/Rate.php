<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $guarded = [];
    public function rate(){
        return $this->belongsTo('App\Models\Product');
    }
    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }
}
