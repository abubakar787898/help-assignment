<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Helpers\HelperMessage;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::get();

        return view('admin.subject.index',compact('subjects'));
        // return  $subjects
        //     ? Helper::sendResponse(['subjects' => $subjects], HelperMessage::fetch("Dead Lines "))
        //     : Helper::sendError(HelperMessage::error("subject Index ")  . "", 400);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:subjects',
        ]);
        $subject = new Subject();
        if (isset($request->name)) $subject->name = $request->name;
        $subject->save();
        Toastr::success('Subject Successfully Saved :)' ,'Success');
        return redirect()->route('admin.subjects.index');
        // return  ($subject->save())
        //     ? Helper::sendResponse(['subject' => $subject], HelperMessage::create("Subject "))
        //     : Helper::sendError(HelperMessage::error("subjectController Store ") . "", 400);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $subject = Subject::find($id);

        // return  $subject
        //     ? Helper::sendResponse(['subject' => $subject], HelperMessage::fetch("Deadline "))
        //     : Helper::sendError(HelperMessage::error("subjectController show ") . "", 400);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $subject = Subject::find($id);
        return view('admin.subject.edit',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);
        $subject = Subject::find($id);
        if (isset($request->name)) $subject->name = $request->name;

        $subject->save();
        Toastr::success('Subject Successfully Updated :)' ,'Success');
        return redirect()->route('admin.subjects.index');
     
        // return  ($subject->save())
        //     ? Helper::sendResponse(['subject' => $subject], HelperMessage::update("Subject "))
        //     : Helper::sendError(HelperMessage::error("subjectController Store ") . "", 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subject = Subject::find($id)->delete();
        Toastr::success('Subject Successfully Deleted :)','Success');
        return redirect()->back();
        // return  $subject
        //     ? Helper::sendResponse(['subject' => $subject], HelperMessage::delete("DeadLLine "))
        //     : Helper::sendError(HelperMessage::error("DeadLLineController delete ") . "", 400);
    }
}
