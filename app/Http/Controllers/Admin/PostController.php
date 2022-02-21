<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        
        return view('admin.posts.posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact("categories"));
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
            "title" => "required|string|max:100",
            "content" => "required",
            "image" => "nullable|mimes:jpeg,jpg,png|max:2048",
            "published" => "sometimes|accepted",
            "category_id" => "nullable|exists:categories,id",
        ]);
        $data = $request->all();

        $newPost = new Post();
        $newPost->title = $data['title'];
        $newPost->content = $data['content'];
        $newPost->category_id = $data['category_id'];
        
        if(isset($data['published'])){
            $newPost->published = true;
        }
        else $newPost->published = false;

        $slug = Str::of($newPost->title)->slug('-');
        $var = 1;
        while( Post::where("slug", $slug)->first()){
            $slug = Str::of($newPost->title)->slug('-')."-{$var}";
            $var++;
        }
        $newPost->slug = $slug;

        if(isset($data['image'])){
            $path = Storage::put("uploads", $data['image']);

            $newPost->image = $path;
        }

        $newPost->save();

        return redirect()->route("posts.show", $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            "title" => "required|string|max:100",
            "content" => "required",
            "image" => "nullable|mimes:jpeg,jpg,png|max:2048",
            "published" => "sometimes|accepted",
            "category_id" => "nullable|exists:categories,id",
        ]);

        $data = $request->all();

        if($post->title != $data['title']){
            $post->title = $data['title'];

            $slug = Str::of($post->title)->slug('-');

            if($slug != $post->slug){
                $var = 1;

                while( Post::where("slug", $slug)->first()){
                    $slug = Str::of($post->title)->slug('-')."-{$var}";
                    $var++;
                }
    
                $post->slug = $slug;
            }
        }

        $post->content = $data['content'];
        $post->category_id = $data['category_id'];

        if(isset($data['published'])){
            $post->published = true;
        }
        else $post->published = false;

        if(isset($data['image'])){
            Storage::delete($post->image);

            $path = Storage::put("uploads", $data['image']);

            $post->image = $path;
        }

        $post->save();

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete($post->image);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
