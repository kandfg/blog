@extends('layouts.admin_app')
@section('content')
<h2>商品列表<h2>
<div>
    <input type="button" class="import" value="匯入excel">
</div>
<span>商品總數:{{$productCount}}</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<table>
    <thead>
        <tr>
            <td>編號</td>
            <td>標題</td>
            <td>價錢</td>
            <td>數量</td>
            <td>內容</td>
            <td>圖片</td>
            <td>功能</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->title}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->content}}</td>
                <td><a href="{{$product->image_url}}">圖片連結</a></td>
                <td>
                    <input type="button" class="upload_image" data-id={{$product->id}} value="上傳圖片">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div>
    @for($i = 1; $i <= $productPages; $i++)
        <a href="/admin/products?page={{ $i }}">第{{ $i }}頁</a> &nbsp;
    @endfor
</div>
<script>
    $('.upload_image').click(function(){
        $('#product_id').val($(this).data('id'))
        $('#upload_image').modal()
    })
    $('.import').click(function(){
        $('#import').modal()
    })
</script>
@endsection