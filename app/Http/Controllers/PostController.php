<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $post = Profile::where('user_id', $user->id)->first();

        return view('profile', [
            'user' => $user,
            'profile' => $post,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $data = request()->validate([
            'caption' => 'required',
            'postpic' => ['required', 'image'],
        ]);

        $user = Auth::user();
        $post = new Post();
        $imagePath = request('postpic')->store('uploads', 'public');

        $post->user_id = $user->id;
        $post->caption = request('caption');
        $post->image = $imagePath;
        $saved = $post->save();

        if ($saved) {
            return redirect('/profile');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($postID)
    {
        $post = Post::where('id', $postID)->first();
        $user = Auth::user();

        return view('post.show', [
            'post' => $post,
            'user' => $user
        ]);
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
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        //
        $data = request()->validate([
            'caption' => 'required',
            'postpic' => 'image',
        ]);
        // Load the existing profile
        $user = Auth::user();
        $postId = $post->id;
        if (empty($post)) {
            $post = new Post();
            $post->user_id = $user->id;
        }
        $post->caption = request('caption');
        // Save the new profile pic... if there is one in the request()!
        if (request()->has('postpic')) {
            $imagePath = request('postpic')->store('uploads', 'public');
            $post->image = $imagePath;
        }
        // Now, save it all into the database
        $updated = $post->save();
        if ($updated) {
            return redirect("/post/$postId");
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
        //
        $success_delete = $post->delete();
        if ($success_delete) :
            return redirect("/profile");
        endif;
    }
}
