<?php

namespace App\Http\Controllers;

use App\Http\Services\ShortUrlService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = DB::table('products')->get();
        //$data = Product::get();
        $data = json_decode(Redis::get('products'));

        return response($data);
    }

    public function checkProduct(Request $request)
    {
        $id = $request->all()['id'];
        $product = Product::find($id);
        if ($product->quantity > 0) {
            return response(true);
        } else {
            return response(false);
        }
    }

    public function sharedUrl($id)
    {
        $service = new ShortUrlService();
        $url = $service->makeShortUrl("http://localhost:8000/products/$id");

        return response(['url' => $url]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->getData();
        $newData = $request->all();
        $data->push(collect($newData));
        dump($data);

        return response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = $request->all();
        $data = $this->getData();
        $selectData = $data->where('id', $id)->first();
        $selectData = $selectData->merge(collect($form));

        return response($selectData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->getData();
        $data = $data->filter(function ($product) use ($id) {
            return $product['id'] != $id;
        });

        return response($data->values());
    }

    public function getData()
    {
        return collect([
            collect([
                'id' => 0,
                'title' => '測試商品一',
                'content' => '這是很棒的商品',
                'price' => 30,
            ]),
            collect([
                'id' => 1,
                'title' => '測試商品二',
                'content' => '這是有點棒的商品',
                'price' => 20,
            ]),
        ]);
    }
}
