<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Request $request) {
    $name = request('name');
    $pathInStorage = 'orders/' . $name . rand(1111, 9999) . '.pdf';
    $request->file('doc')->storeAs('/public', $pathInStorage);

    // create a new patient using the form data
    $order = new \App\Order;
    $order->name = $name;
    $order->description = request('description');
    $order->path = $pathInStorage;
    $pat_id = request('patient_id');
    if($pat_id != null) {
    $order->patient_id = request('patient_id');
    }
    $order->completed = request('completed');

    // save it to the database
    $order->save();

    // redirect to home page
    return redirect()->route('orders.index')->with('message','Order has been added successfully');
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $orderUpdate = $request->all();
        $order->update($orderUpdate);
        return redirect()->route('orders.index')->with('message','Order has been updated successfully');
    }

    public function complete(Request $request)
    {
        $id = $request->order_id;
        Order::where('id', $id)
         ->update(['completed' => 1]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $orderFile = $order->path;
        File::delete('storage/' . $orderFile);
        $order->delete();
        return redirect()->route('orders.index')->with('message','Order has been deleted successfully');
    }
}
