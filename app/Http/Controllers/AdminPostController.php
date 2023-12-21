<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\author;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts= Post::with('author')->get();
        return json_encode($posts);
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
        $upload = $request->file('upload');
        $uploadName = time() . '_' . $upload->getClientOriginalName();
        $uploadPath = public_path('uploads'); 
        $upload->move($uploadPath, $uploadName);
        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'imgUrl' => $uploadName, 
            'published_at' => now(), 
            'author_id' => $request->input('author_id'), 
        ]);

        $post->save();

        $author = Author::find($request->input('author_id'));
        $author->posts()->save($post);

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        return json_encode($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
