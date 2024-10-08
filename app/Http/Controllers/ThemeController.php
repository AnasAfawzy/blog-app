<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(4);
        $sliderblogs = Blog::latest()->take(5)->get();
        return view('theme.index', compact('blogs', 'sliderblogs'));
    }
    public function category($id)
    {
        $category_name = Category::find($id)->name;
        $blogs = Blog::where('category_id', $id)->paginate(4);
        return view('theme.category', compact('blogs', 'category_name'));
    }
    public function contact()
    {
        return view('theme.contact');
    }
}
