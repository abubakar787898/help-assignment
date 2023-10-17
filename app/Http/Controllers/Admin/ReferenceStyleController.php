<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Helpers\HelperMessage;
use App\Http\Controllers\Controller;
use App\Models\ReferenceStyle;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ReferenceStyleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $referencestyles = ReferenceStyle::get();

        return view('admin.referencestyle.index',compact('referencestyles'));
        // return  $referencestyles
        //     ? Helper::sendResponse(['referencestyles' => $referencestyles], HelperMessage::fetch("Dead Lines "))
        //     : Helper::sendError(HelperMessage::error("referencestyle Index ")  . "", 400);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.referencestyle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:reference_styles',
        ]);
        $referencestyle = new ReferenceStyle();
        if (isset($request->name)) $referencestyle->name = $request->name;
        $referencestyle->save();
        Toastr::success('ReferenceStyle Successfully Saved :)' ,'Success');
        return redirect()->route('admin.reference_styles.index');
        // return  ($referencestyle->save())
        //     ? Helper::sendResponse(['reference_style' => $referencestyle], HelperMessage::create("ReferenceStyle "))
        //     : Helper::sendError(HelperMessage::error("referencestyleController Store ") . "", 400);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $referencestyle = ReferenceStyle::find($id);

        // return  $referencestyle
        //     ? Helper::sendResponse(['reference_style' => $referencestyle], HelperMessage::fetch("Deadline "))
        //     : Helper::sendError(HelperMessage::error("referencestyleController show ") . "", 400);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $reference_style = ReferenceStyle::find($id);
        return view('admin.referencestyle.edit',compact('reference_style'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);
        $referencestyle = ReferenceStyle::find($id);
        if (isset($request->name)) $referencestyle->name = $request->name;

        $referencestyle->save();
        Toastr::success('ReferenceStyle Successfully Updated :)' ,'Success');
        return redirect()->route('admin.reference_styles.index');
     
        // return  ($referencestyle->save())
        //     ? Helper::sendResponse(['reference_style' => $referencestyle], HelperMessage::update("ReferenceStyle "))
        //     : Helper::sendError(HelperMessage::error("referencestyleController Store ") . "", 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reference_style = ReferenceStyle::find($id)->delete();
        Toastr::success('ReferenceStyle Successfully Deleted :)','Success');
        return redirect()->back();
        // return  $reference_style
        //     ? Helper::sendResponse(['reference_style' => $reference_style], HelperMessage::delete("DeadLLine "))
        //     : Helper::sendError(HelperMessage::error("DeadLLineController delete ") . "", 400);
    }
}
