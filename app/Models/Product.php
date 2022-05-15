<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
class Product extends Model
{
    use Sluggable;
    use CrudTrait;
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'images' => 'array'
    ];
    public function setImagesAttribute($value)
    {
        $attribute_name = "images";
        $attributeNameSub = "thumbnail";
        $disk = "public";
        $destination_path = "folder_1/subfolder_1";
        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);

    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
