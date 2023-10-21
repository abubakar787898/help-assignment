<?php

namespace App\Http\Controllers;

use App\Mail\AdminOrder;
use App\Mail\Order as MailOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserOrderController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'myfile' => 'required|file|max:25000', // 25MB maximum size
        ]);

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
        $file = $request->file('myfile');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName, 'public');
        // $path = $request->file('myfile')->storeAs('uploads', $request->file('myfile')->getClientOriginalName(), 'public');
        // $path = $request->file('myfile')->store('uploads', 'public');
        $order->attachements = "uploads".'/'.$fileName;
        if($order->save()){
        Mail::to($order->email)->send(new MailOrder($order));
        Mail::to("assignmentservice883@gmail.com")->send(new AdminOrder($order));
    }
        Toastr::success('Order Placed Successfully :)' ,'Success');
        
        return redirect()->route('home');
  
    }
//     public function store(Request $request)
// {
//     $request->validate([
//         'myfile' => 'required|file|max:25000', // 25MB maximum size
//     ]);

//     $file = $request->file('myfile');

   
//         $order = new Order;
//         $order->topic = $request->topic ?? null;
//         $order->no_of_reference = $request->no_of_reference ?? null;
//         $order->paper_type_id = $request->paper_type_id ?? null;
//         $order->dead_line_id = $request->dead_line_id ?? null;
//         $order->subject_id = $request->subject_id ?? null;
//         $order->no_word_id = $request->no_words ?? null;
//         $order->education_level_id = $request->education_level_id ?? null;
//         $order->reference_style_id = $request->reference_style_id ?? null;
//         $order->detail = $request->detail ?? null;
//         $order->user_name = $request->user_name ?? null;
//         $order->email = $request->email ?? null;
//         $order->mobile = $request->mobile ?? null;
//         $order->country = $request->country ?? null;

        
//         $path = storage_path('images/');
//         !is_dir($path) &&
//             mkdir($path, 0777, true);
//             if($file ) {
//             $fileName   = time() . $file->getClientOriginalName();
//             Storage::disk('public')->put($path . $fileName, File::get($file));
//             // $fileData = $this->uploads($file,$path);
           
//         }
       
      
//             $order->save();
//             Toastr::success('Order Placed Successfully :)', 'Success');
//             return redirect()->route('home');
        
    
// }

}
