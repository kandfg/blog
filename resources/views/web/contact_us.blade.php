@extends('layouts.app')
@section('content')
<h2>聯絡我們<h2>
<form action="">
    請問您是:<input type="text"> <br>
    請問你的消費時間: <input type="date"> <br>
    你消費的商品種類:
    <select name="" id="">
        <option value="物品">物品</option>
        <option value="食物">食物</option>
    </select> <br>
    <button>送出</button>
</form>

@endsection
