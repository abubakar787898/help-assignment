<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = ContactUs::
        orderBy('id', 'desc')
        ->get();
      

     
        return view('admin.contactus.index',compact('contacts'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $contact = ContactUs::find($id);
        return view('admin.contactus.show',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = ContactUs::find($id)->delete();
        Toastr::success('Contact Successfully Deleted :)','Success');
        return redirect()->back();
        // $order = Order::find($id)->delete();

        // return  $order
        //     ? Helper::sendResponse(['order' => $order], HelperMessage::delete("Order "))
        //     : Helper::sendError(HelperMessage::error("OrderController delete ") . "", 400);
    }
}
