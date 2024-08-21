<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(4);
        return view('theme.index', compact('blogs'));
    }
    public function category($id)
    {
        $blogs = Blog::where('category_id', $id)->paginate(4);
        return view('theme.category', compact('blogs'));
    }
    public function contact()
    {
        return view('theme.contact');
    }
    public function singleblog()
    {
        return view('theme.singleblog');
    }
}
