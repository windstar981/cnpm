<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\PasswordUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use AppMain\Product\Service\AccountService;
use AppMain\Product\Service\ProductService;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class MyAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    protected $accountService;

    public function __construct(AccountService $accountService){
        $this->accountService = $accountService;
    }

    public function account()
    {
        $customer_id = auth()->user()->id ?? null;
        $user = auth()->user();
        $wishList = ProductService::getWishList($customer_id);

        $viewData = [
          "email" => $user->email ?? '',
          "name" => $user->name ?? '',
          "telephone" => $user->telephone ?? '',
          "address" => $user->address ?? '',
            "wishlist"=>$wishList,
        ];
        return view('main.pages.account.my-account')->with($viewData);
    }

    public function storeInfo(AccountRequest $request){
        $userId  = auth()->user()->id;
        $dataAll = $request->toArray();
        unset($dataAll['_token']);
        $this->accountService->UpdateById($userId, $dataAll);
        Session::flash('message', 'Cập nhật thành công');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    public function password(){
        return view('main.pages.account.password');
    }

    public function changePassword(PasswordUpdateRequest $request)
    {
        $userId  = auth()->user()->id;
        $password = $request->password ?? '';
        $password = Hash::make($password);
        $data     = ['password' => $password];
        $this->accountService->UpdateById($userId, $data);
        Session::flash('message', 'Cập nhật thành công');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
}
