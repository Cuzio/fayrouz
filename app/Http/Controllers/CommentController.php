<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function comment(Request $request, $post_id){
        $validator = Validator::make($request->all(), [
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            // dd($request->all());
            return redirect()->back()->withinput()->withErrors($validator->errors());
        }

        if(!auth()->check()){
            return redirect()->back()->with('error', 'Please login to comment on this post');
        }

        $formField = [
            'comment' => $request->input('comment'),
            'user_id' => auth()->id(),
            'post_id' => $post_id,
        ];

        $comment =Comment::create($formField);

        if($comment){
            return redirect()->back()->with('success', "Comment successfully created");
        }
   }
}