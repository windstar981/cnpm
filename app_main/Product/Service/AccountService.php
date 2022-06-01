<?php

namespace AppMain\Product\Service;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AccountService
{
    public function UpdateById($prod_id, $data=[])
    {
        $product = Customer::where('id', $prod_id)->update($data);
    }

}
