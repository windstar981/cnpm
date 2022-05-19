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

    public static  function getCart($customer_id){
        return DB::table('carts')->where('customer_id', $customer_id)->get();
    }

    public static  function getProductCart($carts){
        $productCart = [];
        foreach ($carts as $cart) {
            array_push($productCart, DB::table('products')->where('id', $cart->product_id)->first());
        }
        return $productCart;
    }
    public function findBySlug($slug)
    {
        $product = DB::table('products')->where('slug', $slug)->first();
        return $product;
    }
}
