<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::Class);
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Responsein
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::Class);
        $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:5|max:500'

        ]);
        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->view_count++;
        $post->save();
        return view('posts.show', [
            'post' =>$post
        ]);

    }

    public function search(Request $request){
        $search_text = $request->input('title');

        $posts = Post::where('title','LIKE', '%'.$search_text.'%')->paginate(10);
        $posts->appends(['search' => $search_text]);
        return view('posts.index')->with('posts', $posts);
    }

//    public function search(Request $request, $title){
//        $posts = Post::where('user_id', $request->user()->id)->where('title','LIKE', '%'.$title.'%')
//            ->orderBy('created_at', 'DESC')->get();
//        return new PostCollection($posts);
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post);
        return view('posts.edit', [
            'post' => $post
        ]);
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
        $post = Post::findOrFail($id);
        $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:5|max:500'

        ]);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');

    }
}
