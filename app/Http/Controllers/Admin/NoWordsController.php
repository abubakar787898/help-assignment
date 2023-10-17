<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Helpers\HelperMessage;
use App\Http\Controllers\Controller;
use App\Models\NoWords;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class NoWordsController extends Controller
{
    public function index()
    {
        $words = NoWords::get();

        return view('admin.word.index',compact('words'));
        // return  $words
        //     ? Helper::sendResponse(['words' => $words], HelperMessage::fetch("Dead Lines "))
        //     : Helper::sendError(HelperMessage::error("word Index ")  . "", 400);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.word.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:no_words',
        ]);
        $word = new NoWords();
        if (isset($request->name)) $word->name = $request->name;
        $word->save();
        Toastr::success('Words Successfully Saved :)' ,'Success');
        return redirect()->route('admin.no_words.index');
        // return  ($word->save())
        //     ? Helper::sendResponse(['word' => $word], HelperMessage::create("NoWords "))
        //     : Helper::sendError(HelperMessage::error("wordController Store ") . "", 400);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $word = NoWords::find($id);

        // return  $word
        //     ? Helper::sendResponse(['word' => $word], HelperMessage::fetch("Deadline "))
        //     : Helper::sendError(HelperMessage::error("wordController show ") . "", 400);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $word = NoWords::find($id);
        return view('admin.word.edit',compact('word'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);
        $word = NoWords::find($id);
        if (isset($request->name)) $word->name = $request->name;

        $word->save();
        Toastr::success('No Words Successfully Updated :)' ,'Success');
        return redirect()->route('admin.no_words.index');
     
        // return  ($word->save())
        //     ? Helper::sendResponse(['word' => $word], HelperMessage::update("NoWords "))
        //     : Helper::sendError(HelperMessage::error("wordController Store ") . "", 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $word = NoWords::find($id)->delete();
        Toastr::success('NoWords Successfully Deleted :)','Success');
        return redirect()->back();
        // return  $word
        //     ? Helper::sendResponse(['word' => $word], HelperMessage::delete("DeadLLine "))
        //     : Helper::sendError(HelperMessage::error("DeadLLineController delete ") . "", 400);
    }
}
