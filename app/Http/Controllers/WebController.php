<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class WebController extends Controller
{
    public $notifications = [];

    public function __construct()
    {
        $user = User::find(0);
        $this->notifications = $user->notifications ?? [];
    }

    public function index()
    {
        $products = Product::all();

        return view('web.index', ['products' => $products, 'notifications' => $this->notifications]);
    }

    public function contactUs()
    {
        return view('web.contact_us', ['notifications' => $this->notifications]);
    }

    public function readNotification(Request $request)
    {
        $id = $request->all()['id'];
        DatabaseNotification::find($id)->markAsRead();

        return response(['result' => true]);
    }
}
