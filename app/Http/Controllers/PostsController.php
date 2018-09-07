<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // Limit
        // $posts = Post::orderBy('created_at', 'asc')->take(1)->get();

        // $posts = Post::orderBy('created_at', 'asc')->get();

        // Pagination
        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'image'  => 'image|nullable|max:1999',
        ]);

        // handle file upload
        if ($request->hasFile('image')) 
        {
            // Get the filename with extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        // create post
        $post = new Post;
        $post->title    = $request->input('title');
        $post->body     = $request->input('body');
        $post->user_id  = auth()->user()->id;
        $post->image    = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Published.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // check for correct user id
        if (auth()->user()->id !==$post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required'
        ]);

        $post = Post::find($id);

        // handle file upload
        if ($request->hasFile('image')) 
        {
            // Delete existing image
            Storage::delete('public/images/'.$post->image);
            // Get the filename with extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        }

        // create post
        $post->title    = $request->input('title');
        $post->body     = $request->input('body');

        if ($request->hasFile('image')) 
        {
            $post->image = $fileNameToStore;
        }

        $post->save();

        return redirect('/posts')->with('success', 'Post Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // check for correct user id
        if (auth()->user()->id !=$post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        if ($post->image != 'noimage.jpg') {
            // Delete image
            Storage::delete('public/images/'.$post->image);
        }

        $post->delete(); 
        return redirect('/posts')->with('success', 'Post Deleted.');
    }
}
