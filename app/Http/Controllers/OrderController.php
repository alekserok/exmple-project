<?php

namespace App\Http\Controllers;

use App\Order;
use App\Performer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $order = null;

        if ($request->has('performer_id'))
            $order = Order::make(['performer_id' => $request->get('performer_id')]);

        return view('orders.create', compact('order'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'performer_id' => 'required',
            'type' => 'required',
            'duration' => 'required',
            'date' => 'required',
            'time_slot' => 'required',
            'message' => 'required'
        ]);

        $order = Order::make($request->all());
        $order->services = $request->get('services');
        session(['order' => $order]);

        return ['status' => 'ok'];
    }

    public function confirmForm()
    {
        $order = session('order');

        if (!$order) return redirect('orders');

        return view('orders.confirm', compact('order'));
    }

    public function confirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'performer_id' => 'required',
            'payment_method' => 'required',
            'type' => 'required',
            'name' => 'required',
            'email' => 'required|confirmed',
            'phone' => 'required',
            'duration' => 'required',
            'date' => 'required',
            'time_slot' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('errors', $validator->messages());
            $order = Order::make($request->all());
            $order->services = $request->get('services');
            session(['order' => $order]);
            return redirect('orders/confirm');
        }

        $order = Order::create($request->all());
        $order->services()->attach($request->get('services'));
        session(['order' => null]);
        return redirect('orders/confirmed')->with('flash_message', trans('Order added!'));
    }
}
