<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customer_id = auth()->user()->id ?? null;
        $productCart = [];
        $carts = DB::table('carts')->where('customer_id', $customer_id)->get();
        foreach ($carts as $cart) {
            array_push($productCart, DB::table('products')->where('id', $cart->product_id)->first());
        }
        $customer_id = auth()->user()->id ?? null;

        if ($customer_id != null) {
            return view('main.pages.cart', ['productCart' => $productCart, 'carts' => $carts]);
        } else {
            return redirect()->route('login');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $pr_id = $request->pr_id;
        $customer_id = auth()->user()->id ?? null;
        if ($customer_id == null) {
            return 'login';
        }
        $product = Product::find($pr_id);
        if ($product->number <= 0) {
            return 'Sản phẩm đã hết hàng';
        }
        if (DB::table('carts')->where([['product_id', '=', $pr_id], ['customer_id', '=', $customer_id]])->count() != 0) {
            return 'Sản phẩm đã có trong giỏ hàng';
        } else {
            $cart = new Cart();
            $cart->customer_id = $customer_id;
            $cart->product_id = $pr_id;
            $cart->quantity = 1;
            $cart->save();
            return 'Đã thêm hàng thành công';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $number = $request->number;
        return $number;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Cart::destroy($id);
    }
}
