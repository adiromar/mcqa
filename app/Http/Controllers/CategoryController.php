<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Posts;
use DB;

class CategoryController extends Controller
{
    public function index()
    {	
    	// $category = Category::orderBy('created_at', 'desc')->get();
    	$category = Category::orderBy('created_at', 'desc')->paginate(20);
        return view('category.index')->with('category', $category);
    }

    public function create()
    {
        return view('category.create');
    }

    public function cat($slug, $id)
    {   
        $category = Category::orderBy('created_at', 'desc')->get();
        $categoryy = Category::find($id);
        
        $postss = $categoryy->posts()->inRandomOrder()->get();
        // $postss = Posts::where("category_name", "=", $category->category_name)->get();
        // dd($posts);die;
        return view('category.show')->with('postss', $postss)->with('categoryy', $categoryy)->with('category', $category);
    }

    public function store(Request $request){
    	$this->validate($request, [
            'category_name' => 'required' ]);

        // create post
        $cat = new Category;
        $cat->category_name = $request->input('category_name');
        $slug = str_replace(' ', '_', $request->input('category_name'));
        $cat->slug = strtolower($slug);  
        $cat->save();

        return redirect('category/index')->with('success', 'Category Created');
    }

    public function destroy($id)
    {
        $caty = Category::find($id);
        $caty->delete();
        return redirect('category/index')->with('success', 'Category Removed.');
    }
}
