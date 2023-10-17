<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Helpers\HelperMessage;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['deadline','education','noword','papertype','reference','subject'])->latest()->get();
// dd($orders);
        return view('admin.order.index',compact('orders'));
        // return  $orders
        //     ? Helper::sendResponse(['orders' => $orders], HelperMessage::fetch("Orders "))
        //     : Helper::sendError(HelperMessage::error("order Index ")  . "", 400);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $this->validate($request,[
        //     'topic' => 'required|unique:orders',
        // ]);
        // $order = new Order();
        // if (isset($request->topic)) $order->topic = $request->topic;
        // if (isset($request->no_of_reference)) $order->no_of_reference = $request->no_of_reference;
        // if (isset($request->paper_type_id)) $order->paper_type_id = $request->paper_type_id;
        // if (isset($request->dead_line_id)) $order->dead_line_id = $request->dead_line_id;
        // if (isset($request->subject_id)) $order->subject_id = $request->subject_id;
        // if (isset($request->no_words)) $order->no_words = $request->no_words;
        // if (isset($request->education_level_id)) $order->education_level_id = $request->education_level_id;
        // if (isset($request->reference_style_id)) $order->reference_style_id = $request->reference_style_id;
       
     
        // return  ($order->save())
        //     ? Helper::sendResponse(['order' => $order], HelperMessage::create("Order "))
        //     : Helper::sendError(HelperMessage::error("orderController Store ") . "", 400);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $order = Order::find($id);

        // return  $order
        //     ? Helper::sendResponse(['order' => $order], HelperMessage::fetch("Order "))
        //     : Helper::sendError(HelperMessage::error("OrderController show ") . "", 400);
    
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $order = Order::with(['deadline','education','noword','papertype','reference','subject'])->find($id);
        return view('admin.order.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $order = Order::find($id);
        if (isset($request->topic)) $order->topic = $request->topic;
        if (isset($request->no_of_reference)) $order->no_of_reference = $request->no_of_reference;
        if (isset($request->paper_type_id)) $order->paper_type_id = $request->paper_type_id;
        if (isset($request->dead_line_id)) $order->dead_line_id = $request->dead_line_id;
        if (isset($request->subject_id)) $order->subject_id = $request->subject_id;
        if (isset($request->no_words)) $order->no_words = $request->no_words;
        if (isset($request->education_level_id)) $order->education_level_id = $request->education_level_id;
        if (isset($request->reference_style_id)) $order->reference_style_id = $request->reference_style_id;
       
        $order->save();
        Toastr::success('Order Successfully Updated :)' ,'Success');
        return redirect()->route('admin.order.index');
        // return  ($order->save())
        //     ? Helper::sendResponse(['order' => $order], HelperMessage::update("Order "))
        //     : Helper::sendError(HelperMessage::error("orderController Store ") . "", 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::find($id)->delete();
        Toastr::success('Order Successfully Deleted :)','Success');
        return redirect()->back();
        // $order = Order::find($id)->delete();

        // return  $order
        //     ? Helper::sendResponse(['order' => $order], HelperMessage::delete("Order "))
        //     : Helper::sendError(HelperMessage::error("OrderController delete ") . "", 400);
    }
}
