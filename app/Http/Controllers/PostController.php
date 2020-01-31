<?php

namespace App\Http\Controllers;

use App\Imports\PostsImport;
use App\Post;
use App\Mail\CreatePost;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use \Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

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
    public function create()
    {
        //
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'postPic' => ['required', 'image'],
        ]);

        $url = $data['postPic']->store('posts', 'public'); //Actual image

        $data['post_pic_url'] = config('app.storage_url') . '/' . $url;

        $image = Image::make($request->file('postPic')->getRealPath())->fit(400);

        $image->save('storage/thumbnails/' . $url); //Thumbnail

        $post = Auth::user()->posts()->create($data);

        //Send The email
        Mail::to(Auth::user()->email)->send(new CreatePost($post));

        //Or this can be done
        // $post = new Post();
        // $post->title = $data['title'];
        // $post->description = $data['description'];
        // $post->post_pic_url = $data['post_pic_url'];
        // $post->user_id = Auth::user()->id;

        // $post->save();

        //or this can be done
        //Post::create($data) + user_id

        return redirect(route('user.profile', Auth::user()->username));
    }

    public function storePosts(Request $request)
    {
        $data = $request->validate([
            'posts' => ['required', 'file', 'mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        ]);

        $path = $data['posts']->store('public');
        $filename = explode('/', $path)[1];

        $posts = Excel::toArray(new PostsImport, $filename, 'public', \Maatwebsite\Excel\Excel::XLSX);

        unset($posts[0][0]);

        foreach ($posts[0] as $post) {
            $newPost = [
                'title' => $post[0],
                'description' => $post[1],
                'post_pic_url' => $post[2],
            ];

            auth()->user()->posts()->create($newPost);
        }

        return redirect(route('user.profile', auth()->user()->username));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $p)
    {
        return view('post.show', ['post' => $p]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $p)
    {
        //
        $p->delete();

        return redirect(route('user.profile', Auth::user()->username));
    }

    public function comment()
    {

    }

    public function like()
    {

    }
}
