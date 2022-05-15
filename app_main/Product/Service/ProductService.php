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
}