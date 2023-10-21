<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostNotify;
use App\Subscriber;
use App\Tag;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::all();
        // $tags = Tag::all();
        // return view('admin.post.create',compact('categories','tags'));
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required',
            // 'categories' => 'required',
            // 'tags' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) {

            $destinationPath = 'image/';

            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move($destinationPath, $profileImage);
            // make unique name for image
            // $currentDate = Carbon::now()->toDateString();
            // $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.jpg';
        
            // if (!Storage::disk('public')->exists('post')) {
            //     Storage::disk('public')->makeDirectory('post');
            // }
        
            // $postImage = Image::make($image)->resize(1600, 1066)->encode('jpg');
        
            // // Store the image and get the full path
            // $filePath = 'post/' . $imageName;
            // Storage::disk('public')->put($filePath, $postImage->stream());
        
            
            // // Get the full URL
            // $fullPath = Storage::disk('public')->url($filePath);
        
        } else {
            $profileImage = "default.png";
            $fullPath = ''; // or whatever default value you want
        }
        $post = new Post();
        // $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $profileImage;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }
        // $post->is_approved = true;
        $post->save();

        // $post->categories()->attach($request->categories);
        // $post->tags()->attach($request->tags);

        // $subscribers = Subscriber::all();
        // foreach ($subscribers as $subscriber)
        // {
        //     Notification::route('mail',$subscriber->email)
        //         ->notify(new NewPostNotify($post));
        // }

        Toastr::success('Post Successfully Saved :)','Success');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        
        return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $categories = Category::all();
        // $tags = Tag::all();
        return view('admin.post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id )
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'required|image|max:2048',
            // 'categories' => 'required',
            // 'tags' => 'required',
            'body' => 'required',
        ]);
        $post=Post::find($id);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        
     
        if (isset($image)) {

            $destinationPath = 'image/';

            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move($destinationPath, $profileImage);
            // make unique name for image
            // $currentDate = Carbon::now()->toDateString();
            // $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.jpg';
        
            // if (!Storage::disk('public')->exists('post')) {
            //     Storage::disk('public')->makeDirectory('post');
            // }
        
            // $postImage = Image::make($image)->resize(1600, 1066)->encode('jpg');
        
            // // Store the image and get the full path
            // $filePath = 'post/' . $imageName;
            // Storage::disk('public')->put($filePath, $postImage->stream());
        
            
            // // Get the full URL
            // $fullPath = Storage::disk('public')->url($filePath);
            $post->image = $profileImage;
        } 
        $post->title = $request->title;
        $post->slug = $slug;
       
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status = true;
        }else {
            $post->status = false;
        }
        // $post->is_approved = true;
        $post->save();

        // $post->categories()->sync($request->categories);
        // $post->tags()->sync($request->tags);

        Toastr::success('Post Successfully Updated :)','Success');
        return redirect()->route('admin.posts.index');
    }

    // public function pending()
    // {
    //     $posts = Post::where('is_approved',false)->get();
    //     return view('admin.post.pending',compact('posts'));
    // }

    // public function approval($id)
    // {
    //     $post = Post::find($id);
    //     if ($post->is_approved == false)
    //     {
    //         $post->is_approved = true;
    //         $post->save();
    //         $post->user->notify(new AuthorPostApproved($post));

    //         $subscribers = Subscriber::all();
    //         foreach ($subscribers as $subscriber)
    //         {
    //             Notification::route('mail',$subscriber->email)
    //                 ->notify(new NewPostNotify($post));
    //         }

    //         Toastr::success('Post Successfully Approved :)','Success');
    //     } else {
    //         Toastr::info('This Post is already approved','Info');
    //     }
    //     return redirect()->back();
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        if (isset($post->image)) {
          unlink(public_path().'/storage/post/'.$post->image);
        }
        // if (Storage::disk('public')->exists('post/'.$post->image))
        // {
        //     Storage::disk('public')->delete('post/'.$post->image);
        // }
        // $post->categories()->detach();
        // $post->tags()->detach();
        $post->delete();
        Toastr::success('Post Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
