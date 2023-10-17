<?php

namespace App\Http\Controllers;

use App\Models\DeadLine;
use App\Models\EducationLevel;
use App\Models\NoWords;
use App\Models\PaperType;
use App\Models\Post;
use App\Models\ReferenceStyle;
use App\Models\Subject;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $papertypes=PaperType::get();
        $deadlines=DeadLine::get();
        $subjects=Subject::get();
        $nowords=NoWords::get();
        $educationlevels=EducationLevel::get();
        $referencestyles=ReferenceStyle::get();
        return view('welcome',compact('papertypes','deadlines','subjects','nowords','educationlevels','referencestyles'));
    }
    public function blog()
    {

        $posts=Post::get();
     
        return view('blog',compact('posts'));
    }
    public function blogshow($slug)
    {

        $post=Post::where('slug',$slug)->first();
     
        return view('blogdetail',compact('post'));
    }
}
