<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts= Post::all();
        return view('posts.index',['posts'=>$posts]);
    }

    public function getSinglePost($id)
    {
        // Use the $id parameter to fetch the post
        $post = Post::find($id);

        // Add your logic here...

        // Return a response, for example:
        return view('posts.singlePost', ['post' => $post]);
    }

    public function contact(Request $request){
        $result=[
            'success' => true ,
            'message' =>'successfully Thank you  .... '. $request->input('name')
        ];
        
        return json_encode($result);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
