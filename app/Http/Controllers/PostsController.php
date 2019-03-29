<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Category;
use DB;
use Session;

class PostsController extends Controller
{
    //

    public function index()
    {
        $posts = Posts::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    public function create()
    {	
    	$category = Category::orderBy('created_at', 'desc')->get();
        return view('posts.create')->with('category', $category);
    }

    public function edit($id)
    {   
        $category = Category::orderBy('created_at', 'desc')->get();
        $post = Posts::find($id);
        return view('posts.edit')->with('post', $post)->with('category', $category);
    }

    public function store(Request $request){
    	$this->validate($request, [
            'question' => 'required',
            'category_name' => 'required' ]);

        // create post
        $post = new Posts;
        $post->post_name = $request->input('question');  
        $post->category_name = $request->input('category_name'); 
        $post->category_id = $request->input('category_id');
        $post->option_a = $request->input('option_a');   
        $post->option_b = $request->input('option_b'); 
        $post->option_c = $request->input('option_c'); 
        $post->option_d = $request->input('option_d'); 
        $post->correct_option = $request->input('correct_option'); 
        $post->save();

        return redirect('posts/index')->with('success', 'Post Created Successfully');
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'question' => 'required',
            'category_name' => 'required' ]);
        // echo $id;die;
        // dd($_POST);die;
        // update post
        $new_post = Posts::find($id);
        $new_post->post_name = $request->input('question');  
        $new_post->category_name = $request->input('category_name'); 
        $new_post->category_id = $request->input('category_id');
        $new_post->option_a = $request->input('option_a');   
        $new_post->option_b = $request->input('option_b'); 
        $new_post->option_c = $request->input('option_c'); 
        $new_post->option_d = $request->input('option_d'); 
        $new_post->correct_option = $request->input('correct_option'); 
        $new_post->save();

        return redirect('posts/index')->with('success', 'Post Updated Successfully');
    }


    public function destroy($id)
    {
        $post = Posts::find($id);
        $post->delete();
        return redirect('posts/index')->with('success', 'Post Removed.');
    }
}
