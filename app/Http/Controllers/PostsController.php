<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $posts = Post::orderBy('updated_at', 'desc')->paginate(10);
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
        	'body' => 'required',
        	'cover-image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('cover-image');
        
        //Get Filename with Extension
        $filenameWithExt = $request->file('cover-image')->getClientOriginalName();
        
        //Get just filename
        $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        //Get just ext
        $fileExt = $image->getClientOriginalExtension();

        //$input['imagename'] = $filenameWithoutExt. '-' . time().'.'.$fileExt;
        $input['imagename'] = 'coverimage-' . time().'.'.$fileExt;
        
        $destinationPath = public_path('/cover-images');
        $image->move($destinationPath, $input['imagename']);

        //$this->postImage->add($input);

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $input['imagename'];
        $post->save();

        return redirect('/posts')->with('success', 'Post Created Sucessfully!');
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
        return view('posts.detail')->with('post', $post);
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
        
        if(auth()->user()->id != $post->user_id){
        	return redirect('/posts')->with('error', 'Unauthorized access!');
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
        	'body' => 'required',
        	'cover-image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->file('cover-image')){

        	$image = $request->file('cover-image');
	        
	        //Get Filename with Extension
	        $filenameWithExt = $request->file('cover-image')->getClientOriginalName();
	        
	        //Get just filename
	        $filenameWithoutExt = pathinfo($filenameWithExt, PATHINFO_FILENAME);

	        //Get just ext
	        $fileExt = $image->getClientOriginalExtension();

	        //$input['imagename'] = $filenameWithoutExt. '-' . time().'.'.$fileExt;
	        $input['imagename'] = 'coverimage-' . time().'.'.$fileExt;
	        
	        $destinationPath = public_path('/cover-images');
	        $image->move($destinationPath, $input['imagename']);
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if(!empty($input['imagename'])) $post->cover_image = $input['imagename'];
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated Sucessfully!');
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

        if(auth()->user()->id != $post->user_id){
        	return redirect('/posts')->with('error', 'Unauthorized access!');
        }
        
        $post->delete();

        return redirect('/posts')->with('success', 'Post Deleted Sucessfully!');
    }
}
