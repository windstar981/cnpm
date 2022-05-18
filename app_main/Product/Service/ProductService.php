<?php

namespace AppMain\Product\Service;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

    class ProductService
{
    public function UpdateById($prod_id, $data=[])
    {
        $product = Product::where('id', $prod_id)->update($data);
    }
    public static function getNewProduct(){
        return DB::table('products')->orderByDesc('created_at')->get();
    }


    public function findBySlug($slug)
    {
        $product = DB::table('products')->where('slug', $slug)->first();
        return $product;
    }

}
