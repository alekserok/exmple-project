<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $orders = Order::join('performers as p', 'p.id', '=', 'orders.performer_id')
                ->select(['orders.*'])
                ->where('p.name', 'LIKE', "%$keyword%")
                ->orWhere('orders.name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $orders = Order::latest()->paginate($perPage);
        }

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'performer_id' => 'required',
			'payment_method' => 'required',
			'type' => 'required',
			'name' => 'required',
			'email' => 'required',
			'phone' => 'required',
			'duration' => 'required',
			'date' => 'required',
			'time_slot' => 'required',
			'message' => 'required'
		]);
        $requestData = $request->all();

        $order = Order::create($requestData);
        $order->services()->attach($request->get('services'));

        return redirect('admin/orders')->with('flash_message', 'Order added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'performer_id' => 'required',
			'payment_method' => 'required',
			'type' => 'required',
			'name' => 'required',
			'email' => 'required',
			'phone' => 'required',
			'duration' => 'required',
			'date' => 'required',
			'time_slot' => 'required',
			'message' => 'required'
		]);
        $requestData = $request->all();

        $order = Order::findOrFail($id);
        $order->update($requestData);
        $order->services()->sync($request->get('services'));

        return redirect('admin/orders')->with('flash_message', 'Order updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return redirect('admin/orders')->with('flash_message', 'Order deleted!');
    }
}
