<?php

namespace AppMain\Product\Service;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Rate;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function UpdateById($prod_id, $data = [])
    {
        $product = Product::where('id', $prod_id)->update($data);
    }

    public static function getNewProduct()
    {
        return DB::table('products')->orderByDesc('created_at')->get();
    }

    public static function getCart($customer_id)
    {
        return DB::table('carts')->where('customer_id', $customer_id)->get();
    }

    public static function getProductCart($carts)
    {
        $productCart = [];
        foreach ($carts as $cart) {
            array_push($productCart, DB::table('products')->where('id', $cart->product_id)->first());
        }

        return $productCart;
    }

    public static function getWishList($id)
    {
        $temp = DB::table('wish_lists')->where('customer_id', $id)->get();
        $all = DB::table('products')->get();
        $arr = [];
        foreach ($temp as $pr) {
            foreach ($all as $product) {
                if ($product->id == $pr->product_id) {
                    array_push($arr, $product);
                }
            }
        }
        return $arr;
    }

    public function findBySlug($slug)
    {
        $product = DB::table('products')->where('slug', $slug)->first();

        return $product;
    }

    public function getSameProduct($category)
    {
        $products = DB::table('products')->where('category_id', $category)->get();

        return $products;
    }

    public function getRates($product)
    {
        $products = Rate::where('product_id', $product)->get();

        return $products;
    }

    public function storeRate($data)
    {
        return Rate::create($data);
    }
}
