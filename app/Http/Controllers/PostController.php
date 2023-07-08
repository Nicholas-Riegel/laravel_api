<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'body'=>'required',
        ]);

        try{
            Post::create($request->post());

            return response()->json(['message'=>'Post Created Successfully!!']);
        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message'=> $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json(['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'body'=>'required',
        ]);

        try{

            // $post->fill($request->post())->update();

            // Find the post by ID
            $post = Post::findOrFail($id);

            // Update the post attributes
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->save();

            return response()->json(['message'=>'Post Updated Successfully!!']);

        }
        catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try{

            $post->delete();

            return response()->json(['message'=>'Post Deleted Successfully!!']);
            
        } 
        catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
