<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', 
            'email' => 'required', 
            'body' => 'required', 
        ]);

        $contact = new ContactUs();
        if (isset($request->name)) $contact->name = $request->name;
        if (isset($request->email)) $contact->email = $request->email;
        if (isset($request->body)) $contact->body = $request->body;
     
        $contact->save();
        Toastr::success('Your Query Placed Successfully :)' ,'Success');
        
        return redirect()->back();
  
    }
}
