@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="css/try.css">

<h2 style="margin-top:40px">商品列表<h2>
<h2 class="fake">商品假列表</h2>
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-29ShELGAxWUYDsIGf-njL6yGFLs0S7yTEw&usqp=CAU" alt="">
<table>
    <thead>
        <tr>
            <td>標題</td>
            <td>內容</td>
            <td>價格</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            @if ($product->id==1)
                <td class="special-text">{{$product->title}}</td>
            @else
                <td>{{$product->title}}</td>
            @endif
            <td>{{$product->content}}</td>
            <td style="{{$product->price<200 ? 'color:red;font-size:22px':''}}">{{$product->price}}</td>
            <td>
                <input class="check_product" type="button" value="確認商品數量" data-id={{$product->id}}>
                <input class="check_shared_url" type="button" value="分享商品" data-id={{$product->id}}>                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
$('.check_product').on('click',function(){
    $.ajax({
        method:'POST',
        url:'/products/check-product',
        data:{id: $(this).data('id')}
    })
    .done(function(response){
        if(response){
            alert('商品數量充足')
        }
        else{
            alert('商品數量不足')
        }
    })
})
$('.check_shared_url').on('click',function(){
    var id=$(this).data('id');
    $.ajax({
        method:'GET',
        url:`/products/${id}/shared-url`,
    })
    .done(function(msg){
        alert('請分享此縮網址'+msg.url)
    })
})
</script>
@endsection
