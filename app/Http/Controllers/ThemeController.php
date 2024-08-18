<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $catgory = Category::all();
        return view('theme.index', compact('catgory'));
    }
    public function category()
    {
        return view('theme.category');
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
