<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category = $request->category;
        $post->thumbnail = $request->thumbnail->store('images/post/thumbnail');
        $post->slug = Str::slug($request->title);
        if ($post->save()) {
            return response()->json([
                'messages'=>'success'
            ],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$slug)
    {
        $post = Post::where(['slug'=>$slug])->first();
        if ($post) {
            return view('blogs.detail',compact('post'));
        }

        flash('blog tidak ditemukan!')->warning();

        return redirect(route('blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($post = Post::find(decrypt($id))) {
            return view('admin.post.write',compact('post'));
        }
        return back();
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
        $post = Post::find(decrypt($id));
        
        if ($post) {
            $path = str_replace('public','storage/app',public_path())."/$post->thumbnail";

            $post->title = $request->title;
            $post->content = $request->content;
            $post->category = $request->category;
            $post->slug = Str::slug($request->title);
            
            if ($request->hasFile('thumbnail')) {
                $post->thumbnail = $request->thumbnail->store('images/post/thumbnail');
                if (file_exists($path)) {
                    unlink($path);
                }
            }




            if ($post->save()) {
                return response()->json([
                    'messages'=>'success'
                ],200);
            }
        }

        return response()->json([
            'title'=>$request->has('title'),
            'all'=>$request->all(),
            'hasfile'=>$request->hasFile('thumbnail')
        ],500);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function all()
    {
        return response()->json([
            "data"=>Post::orderby('created_at','desc')->get()
        ],200);
    }

    public function updateVisibility(Request $request)
    {
        if($post = Post::find($request->id)){ 
            $post->show = $request->show == "true" ? 1:0;
            $post->save();

            return response()->json([
                "message"=>"success"
            ],200);
        }
        return response()->json([
            "message"=>"post not found"
        ],404);
    }
}
