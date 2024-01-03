<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class PostController extends Controller
{
    public function create(){
        return view('post.create-post');
    }

    public function createPost(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withError($validator->errors());
        }

        $formFields = [
            'title' => $request->title,
            'description' => $request->description,
            // 'image' => $request->image
        ];

        // sdhgfygfgf-post-image.jpg (how the image will be saved)
        
        $image = uniqid().'-'.'post-image'.'.'.$request->image->extension();
        
        // to save the image posted in the database in the project and be saved in posts file that will be created in the public directory

        $request->image->move(public_path('posts'), $image);

        $formFields['image'] = $image;
        $post = Post::create($formFields);

        if($post){
            return redirect('/')->with("success", "Post Created Successfully");
        }else{
            return back()->with("error", "Something went wrong");
        }
    }

    // to get all the posts

    public function allPosts(){
        $posts = Post::all();
        if($posts){
            return view('posts.all-posts', [
                'posts' => $posts
            ]);
        }
    }
}