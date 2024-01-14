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
            // dd($request->all());
            return redirect()->back()->withinput()->withErrors($validator->errors());
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
            return redirect()->back()->with("error", "Something went wrong");
        }
    }

    // to get all the posts

    public function allPosts(){
        $posts = Post::all();
        // all was used to get all the posts in the database. get(), paginate() could also be used to get all the posts. ie to get the array.
        if($posts){
            return view('post.all-posts', [
                'posts' => $posts
            ]);
        }
    }

   public function singlePost($id){
        $singlePost = Post::find($id);
        // find was used because you are to display the data from the database singlarly. first() could be used to get a single data from the database. {$singlePost = Post::where('id', $id)->first();}
        if($singlePost){
            return view('post.single-post', [
                'singlePost' => $singlePost,
            ]);
        }
   }

   public function editPost($id){
    $post = Post::find($id);
    return view('post.edit', [
        'post' => $post,
    ]);
   }

   public function updatePost($id){
    
   }
}