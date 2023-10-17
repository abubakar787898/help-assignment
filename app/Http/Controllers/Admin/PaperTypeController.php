<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Helpers\HelperMessage;
use App\Http\Controllers\Controller;
use App\Models\PaperType;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class PaperTypeController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $papertypes = PaperType::get();

        return view('admin.papertype.index',compact('papertypes'));
        // return  $papertypes
        //     ? Helper::sendResponse(['papertypes' => $papertypes], HelperMessage::fetch("Dead Lines "))
        //     : Helper::sendError(HelperMessage::error("papertype Index ")  . "", 400);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.papertype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:paper_types',
        ]);
        $papertype = new PaperType();
        if (isset($request->name)) $papertype->name = $request->name;
        $papertype->save();
        Toastr::success('Paper Type Successfully Saved :)' ,'Success');
        return redirect()->route('admin.paper_types.index');
        // return  ($papertype->save())
        //     ? Helper::sendResponse(['paper_type' => $papertype], HelperMessage::create("PaperType "))
        //     : Helper::sendError(HelperMessage::error("papertypeController Store ") . "", 400);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $papertype = PaperType::find($id);

        // return  $papertype
        //     ? Helper::sendResponse(['paper_type' => $papertype], HelperMessage::fetch("Deadline "))
        //     : Helper::sendError(HelperMessage::error("papertypeController show ") . "", 400);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $paper_type = PaperType::find($id);
        return view('admin.papertype.edit',compact('paper_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);
        $papertype = PaperType::find($id);
        if (isset($request->name)) $papertype->name = $request->name;

        $papertype->save();
        Toastr::success('PaperType Successfully Updated :)' ,'Success');
        return redirect()->route('admin.paper_types.index');
     
        // return  ($papertype->save())
        //     ? Helper::sendResponse(['paper_type' => $papertype], HelperMessage::update("PaperType "))
        //     : Helper::sendError(HelperMessage::error("papertypeController Store ") . "", 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $paper_type = PaperType::find($id)->delete();
        Toastr::success('PaperType Successfully Deleted :)','Success');
        return redirect()->back();
        // return  $paper_type
        //     ? Helper::sendResponse(['paper_type' => $paper_type], HelperMessage::delete("DeadLLine "))
        //     : Helper::sendError(HelperMessage::error("DeadLLineController delete ") . "", 400);
    }
}
