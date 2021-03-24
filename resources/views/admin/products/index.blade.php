@extends('layouts.app')
@section('content')
<h2>後臺訂單-列表<h2>
<span>訂單總數:{{$productCount}}</span>
<table>
    <thead>
        <tr>
            <td>購買時間</td>
            <td>購買者</td>
            <td>購買清單</td>
            <td>訂單總額</td>
            <td>是否運送</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{$product->created_at}}</td>
                <td>{{$product->user->name}}</td>
                <td>
                    @foreach ($product->productItems as $productItem)
                        {{$productItem->product->title}} &nbsp;
                    @endforeach
                </td>
                <td>{{isset($product->productItems) ? $product->productItems->sum('price') : 0}}</td>
                <td>{{$product->is_shipped}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div>
    @for($i = 1; $i <= $productPages; $i++)
        <a href="/admin/products?page={{ $i }}">第{{ $i }}頁</a> &nbsp;
    @endfor
</div>
@endsection