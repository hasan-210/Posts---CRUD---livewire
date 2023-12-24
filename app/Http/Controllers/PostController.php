<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('post.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:255',
            'category' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,svg,gif|max:20000',
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = new Post();
        $post -> title = $request -> title;
        $post -> body = $request -> body;
        $post -> category_id = $request -> category;
        $post -> user_id = Auth::id();

        if($request->image){
            $filename =time().$request->file('image')->getClientOriginalName();
            $request->image->move(public_path('/assets/images'), $filename);
            $post->image = time().$request->file('image')->getClientOriginalName();
        }

        $post -> save();
        return redirect()->route('posts.index')->with([
            'message' => 'Post created Successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $post = Post::find($id);
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('post.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        {
            $validator = Validator::make($request->all(),[
                'title' => 'required|max:255',
                'category' => 'required',
                'body' => 'required',
                'image' => 'required|mimes:png,jpg,jpeg,svg,gif|max:20000',
            ]);

            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $post =Post::find($id);
            $post -> title = $request -> title;
            $post -> body = $request -> body;
            $post -> category_id = $request -> category;
            $post -> user_id = Auth::id();

            if($request->file('image')){
                    if(File::exists('assets/images/'.$post->image)){
                        unlink('assets/images/'.$post->image);
                    }
                $filename =time().$request->file('image')->getClientOriginalName();
                $request->image->move(public_path('/assets/images'), $filename);
                $post->image = time().$request->file('image')->getClientOriginalName();
            }

            $post -> save();
            return redirect()->route('posts.index')->with([
                'message' => 'Post updated Successfully',
                'alert-type' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if($post->image){
            if(File::exists('assets/images/'.$post->image)){
                unlink('assets/images/'.$post->image);
            }
        }

        $post -> delete();
        return redirect()->route('posts.index')->with([
            'message' => 'Post deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}
