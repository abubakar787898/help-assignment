<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class UserOrderController extends Controller
{
    //
    public function store(Request $request)
    {
        $order = new Order;
        if (isset($request->topic)) $order->topic = $request->topic;
        if (isset($request->no_of_reference)) $order->no_of_reference = $request->no_of_reference;
        if (isset($request->paper_type_id)) $order->paper_type_id = $request->paper_type_id;
        if (isset($request->dead_line_id)) $order->dead_line_id = $request->dead_line_id;
        if (isset($request->subject_id)) $order->subject_id = $request->subject_id;
        if (isset($request->no_words)) $order->no_word_id = $request->no_words;
        if (isset($request->education_level_id)) $order->education_level_id = $request->education_level_id;
        if (isset($request->reference_style_id)) $order->reference_style_id = $request->reference_style_id;
        if (isset($request->detail)) $order->detail = $request->detail;
        if (isset($request->user_name)) $order->user_name = $request->user_name;
        if (isset($request->email)) $order->email = $request->email;
        if (isset($request->mobile)) $order->mobile = $request->mobile;
        if (isset($request->country)) $order->country = $request->country;
    
       
        $order->save();
        Toastr::success('Order Placed Successfully :)' ,'Success');
        return redirect()->route('home');
        // return  ($order->save())
        //     ? Helper::sendResponse(['order' => $order], HelperMessage::update("Order "))
        //     : Helper::sendError(HelperMessage::error("orderController Store ") . "", 400);
    }
}
