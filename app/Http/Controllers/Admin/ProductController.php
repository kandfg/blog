<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productCount = Product::wherehas('productItems')->count();
        $dataPerPage = 2;
        $productPages = ceil($productCount / $dataPerPage);
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;

        $products = Product::productBy('created_at', 'desc')
                        ->offset($dataPerPage * ($currentPage - 1))
                        ->limit($dataPerPage)
                        ->get();

        return view('admin.products.index', ['products' => $products,
                                            'productCount' => $productCount,
                                            'productPages' => $productPages,
                                            ]);
    }
}
