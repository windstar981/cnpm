<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use AppMain\Product\Service\ProductService;

class CheckOutController extends Controller
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
        if ($customer_id == null) {
            return redirect()->route('login');
        }
        $wishList = ProductService::getWishList($customer_id);
        $productCarts = DB::table('carts')->where('customer_id', $customer_id)->get();
        $customer = DB::table('customers')->where('id', $customer_id)->first();
        $arrPr = [];
        foreach ($productCarts as $productCart){
            array_push($arrPr, DB::table('products')->where('id',$productCart->product_id)->first());
        }
        return view('main.pages.checkout', ['carts' => $productCarts, 'customer'=>$customer,'productCarts'=>$arrPr, 'wishlist'=>$wishList] );
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
        $customer_id = auth()->user()->id ?? null;
        if(DB::table('carts')->where('customer_id', $customer_id)->count()<=0){
            return 'Mời bạn thêm sản phẩm vào giỏ hàng';
        }
        $productCarts = DB::table('carts')->where('customer_id',$customer_id)->get();
        foreach ($productCarts as $pr){
            $temp = DB::table('products')->where('id',$pr->product_id)->first();
            if($temp->number<=0){
                return 'Không thể thực hiện đơn hàng này do sản phẩm '. $temp->name.' đã hết hàng mời quý khách đặt lại';
            }
        }
        $order = new Order();
        $order_id = rand(1,1000000000);
        $order->id = $order_id;
        $order->name = $request->name;
        $order->telephone = $request->telephone;
        $order->address = $request->add;
        $order->total = $request->total;
        $order->status = 1;
        $order->customer_id = $customer_id;
        $order->user_id = 1;
        $order->save();
        foreach ($productCarts as $pr){
            $temp = DB::table('products')->where('id',$pr->product_id)->first();
            $orderDetail = new OrderDetail();
            $orderDetail->product_id = $pr->product_id;
            $orderDetail->order_id = $order_id;
            $orderDetail->price = $temp->price-$temp->price_voucher;
            $orderDetail->quantity = $pr->quantity;
            $orderDetail->save();
            $productRoot = Product::find($pr->product_id);
            $productRoot->number = $productRoot->number-$pr->quantity;
            $productRoot->save();
        }
        DB::table('carts')->where('customer_id', $customer_id)->delete();
        return 'Quý khách đã đặt hàng thành công!';
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
    }
}
