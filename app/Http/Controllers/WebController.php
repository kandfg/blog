<?php

namespace App\Http\Controllers;

use App\Models\Product;

class WebController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('web.index', ['products' => $products]);
    }

    public function contactUs()
    {
        return view('web.contact_us');
    }
}
