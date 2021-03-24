<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderDelivery;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orderCount = Order::wherehas('orderItems')->count();
        $dataPerPage = 2;
        $orderPages = ceil($orderCount / $dataPerPage);
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;

        $orders = Order::with(['user', 'orderItems.product'])->orderBy('created_at', 'desc')
                        ->offset($dataPerPage * ($currentPage - 1))
                        ->limit($dataPerPage)
                        ->wherehas('orderItems')
                        ->get();

        return view('admin.orders.index', ['orders' => $orders,
                                            'orderCount' => $orderCount,
                                            'orderPages' => $orderPages,
                                            ]);
    }

    public function delivery($id)
    {
        $order = Order::find($id);
        if ($order->is_shipped) {
            return response(['result' => false]);
        } else {
            $order->update(['is_shipped' => true]);
            $order->user->notify(new OrderDelivery());

            return response(['result' => true]);
        }
    }
}
