<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Helpers\HelperMessage;
use App\Http\Controllers\Controller;
use App\Models\EducationLevel;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class EducationLevelController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educations = EducationLevel::get();

        return view('admin.education.index',compact('educations'));
        // return  $educations
        //     ? Helper::sendResponse(['educations' => $educations], HelperMessage::fetch("Dead Lines "))
        //     : Helper::sendError(HelperMessage::error("education Index ")  . "", 400);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.education.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:education_levels',
        ]);
        $education = new EducationLevel();
        if (isset($request->name)) $education->name = $request->name;
        $education->save();
        Toastr::success('Education Successfully Saved :)' ,'Success');
        return redirect()->route('admin.educations.index');
        // return  ($education->save())
        //     ? Helper::sendResponse(['education' => $education], HelperMessage::create("EducationLevel "))
        //     : Helper::sendError(HelperMessage::error("educationController Store ") . "", 400);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $education = EducationLevel::find($id);

        // return  $education
        //     ? Helper::sendResponse(['education' => $education], HelperMessage::fetch("Deadline "))
        //     : Helper::sendError(HelperMessage::error("educationController show ") . "", 400);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $education = EducationLevel::find($id);
        return view('admin.education.edit',compact('education'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);
        $education = EducationLevel::find($id);
        if (isset($request->name)) $education->name = $request->name;

        $education->save();
        Toastr::success('EducationLevel Successfully Updated :)' ,'Success');
        return redirect()->route('admin.educations.index');
     
        // return  ($education->save())
        //     ? Helper::sendResponse(['education' => $education], HelperMessage::update("EducationLevel "))
        //     : Helper::sendError(HelperMessage::error("educationController Store ") . "", 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $education = EducationLevel::find($id)->delete();
        Toastr::success('EducationLevel Successfully Deleted :)','Success');
        return redirect()->back();
        // return  $education
        //     ? Helper::sendResponse(['education' => $education], HelperMessage::delete("DeadLLine "))
        //     : Helper::sendError(HelperMessage::error("DeadLLineController delete ") . "", 400);
    }
}
