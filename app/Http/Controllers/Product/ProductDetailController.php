<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use AppMain\Product\Service\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductDetailController extends Controller
{
    protected $productSerivce;

    public function __construct(ProductService $productService)
    {
        $this->productSerivce = $productService;
    }

    public function index(Request $request)
    {
        $customer_id = auth()->user()->id ?? null;
        $slug        = $request->slug ?? null;
        $product     = $this->productSerivce->findBySlug($slug);
        if ($product === null) {
            abort(404);
        }
        $carts       = ProductService::getCart($customer_id);
        $productCart = ProductService::getProductCart($carts);
        $sameProduct = $this->productSerivce->getSameProduct($product->category_id);
        $rates       = $this->productSerivce->getRates($product->id);
        $viewData    = [
            "product"     => $product,
            "carts"       => $carts,
            "productCart" => $productCart,
            "sameProduct" => $sameProduct,
            "rates"       => $rates,
        ];

        return view('main.pages.product_detail')->with($viewData);
    }

    public function storeRate(Request $request)
    {
        $request->validate([
            'content_rate' => 'required|min: 10|max: 500',
        ],
            [
                'content_rate.required' => 'Trường nội dụng không được bỏ trống',
                'content_rate,min'      => 'Nhận xét tối thiểu 10 kí tự',
                'content_rate,max'      => 'Nhận xét tối da 500 kí tự',
            ]);
        $userId  = auth()->user()->id;
        $dataAll = [
            'customer_id' => $userId ?? 0,
            'product_id'  => $request->product_id ?? 0,
            'content'     => $request->content_rate ?? '',
        ];
        $this->productSerivce->storeRate($dataAll);
        Session::flash('message', 'Cảm ơn bạn đã gửi đánh giá');
        Session::flash('alert-class', 'alert-success');

        return redirect()->back();
    }
}