<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use AppMain\Product\Service\ProductService;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    protected $productSerivce;
    public function __construct(ProductService $productService)
    {
        $this->productSerivce = $productService;
    }

    public function index(Request $request){
        $customer_id = auth()->user()->id ?? null;
        $slug = $request->slug ?? null;
        $product = $this->productSerivce->findBySlug($slug);
        $carts =  ProductService::getCart($customer_id);
        $productCart = ProductService::getProductCart($carts);
        $viewData = [
          "product" => $product,
          "carts" => $carts,
          "productCart" => $productCart,
        ];
        return view('main.pages.product_detail')->with($viewData);
    }

}