<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeadLine;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class DeadLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deadlines = DeadLine::get();

        return view('admin.deadline.index',compact('deadlines'));
        // return  $deadlines
        //     ? Helper::sendResponse(['deadlines' => $deadlines], HelperMessage::fetch("Dead Lines "))
        //     : Helper::sendError(HelperMessage::error("deadline Index ")  . "", 400);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.deadline.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:dead_lines',
        ]);
        $deadline = new DeadLine();
        if (isset($request->name)) $deadline->name = $request->name;
        $deadline->save();
        Toastr::success('Dead Line Successfully Saved :)' ,'Success');
        return redirect()->route('admin.dead_lines.index');
        // return  ($deadline->save())
        //     ? Helper::sendResponse(['dead_line' => $deadline], HelperMessage::create("DeadLine "))
        //     : Helper::sendError(HelperMessage::error("deadlineController Store ") . "", 400);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $deadline = DeadLine::find($id);

        // return  $deadline
        //     ? Helper::sendResponse(['dead_line' => $deadline], HelperMessage::fetch("Deadline "))
        //     : Helper::sendError(HelperMessage::error("deadlineController show ") . "", 400);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $dead_line = DeadLine::find($id);
        return view('admin.deadline.edit',compact('dead_line'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);
        $deadline = DeadLine::find($id);
        if (isset($request->name)) $deadline->name = $request->name;

        $deadline->save();
        Toastr::success('DeadLine Successfully Updated :)' ,'Success');
        return redirect()->route('admin.dead_lines.index');
     
        // return  ($deadline->save())
        //     ? Helper::sendResponse(['dead_line' => $deadline], HelperMessage::update("DeadLine "))
        //     : Helper::sendError(HelperMessage::error("deadlineController Store ") . "", 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dead_line = DeadLine::find($id)->delete();
        Toastr::success('DeadLine Successfully Deleted :)','Success');
        return redirect()->back();
        // return  $dead_line
        //     ? Helper::sendResponse(['dead_line' => $dead_line], HelperMessage::delete("DeadLLine "))
        //     : Helper::sendError(HelperMessage::error("DeadLLineController delete ") . "", 400);
    }
}
