<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Helpers\HelperMessage;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['deadline', 'education', 'noword', 'papertype', 'reference', 'subject'])
        ->orderBy('id', 'desc')
        ->get();
        Log::info("File Path: $orders");

        // $orders = Order::with(['deadline','education','noword','papertype','reference','subject'])->latest()->get();
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


    
    public function download($id)
    {
        // Logic to retrieve the file path based on the order ID
        $order = Order::find($id);
    
        if ($order->attachements) {
            $filePath = storage_path('app/public/' . $order->attachements);
    
            // Check if the file exists
            if (file_exists($filePath)) {
                // Log the file path for debugging
                Log::info("File Path: $filePath");
    
                // Return the file as a response
                return response()->download($filePath)->deleteFileAfterSend(true);
            } else {
                // Log an error if the file does not exist
                Log::error("File Not Found: $filePath");
    
                // Handle the case when the file does not exist
                Toastr::error('File Not Found :(', 'Error');
            }
        } else {
            // Log an error if the order is not found
            Log::error("Order Not Found: Order ID $id");
    
            // Handle the case when the order is not found
            Toastr::error('Order Not Found :(', 'Error');
        }
    
        // If the code reaches here, it means there was an error or the file was not found
        // Redirect the user to a specific route or back to the previous page
        return redirect()->back();
    }
// public function download($id)
// {
//     // Logic to retrieve the file path based on the order ID
//     $order = Order::find($id);
//     Log::info("File Path: $order");

//     if ($order) {
//         $filePath = storage_path('app/public/' . $order->attachements);

//         // Log the file path for debugging
//         Log::info("File Path: $order");

//         // Check if the file exists
//         if (file_exists($filePath)) {
//             // Return the file as a response
//             return response()->download($filePath);
//         } else {
//             // Log an error if the file does not exist
//             Log::error("File Not Found: $filePath");

//             // Handle the case when the file does not exist
//             Toastr::error('File Not Found :(', 'Error');
//         }
//     } else {
//         // Log an error if the order is not found
//         Log::error("Order Not Found: Order ID $id");

//         // Handle the case when the order is not found
//         Toastr::error('Order Not Found :(', 'Error');
//     }
// }

    
}
