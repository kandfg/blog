<h2>後臺訂單-列表<h2>
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
        @foreach ($orders as $order)
            <tr>
                <td>{{$order->created_at}}</td>
                <td>{{$order->user->name}}</td>
                <td>
                    @foreach ($order->orderItems as $orderItem)
                        {{$orderItem->product->title}} &nbsp;
                    @endforeach
                </td>
                <td>訂單總額</td>
                <td>是否運送</td>
            </tr>
        @endforeach
    </tbody>
</table>