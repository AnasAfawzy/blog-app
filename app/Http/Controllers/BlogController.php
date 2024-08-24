<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('create', 'myBlogs');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (Auth::check()) {
        $categories = Category::all();
        return view('theme.blogs.create', compact('categories'));
        // }
        // abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        $tempimage = $request->image;
        $image = time() . '_' . $tempimage->getClientOriginalName();
        $tempimage->storeAs('blogs', $image, 'public');
        $data['image'] = $image;
        $data['user_id'] = Auth::user()->id;
        Blog::create($data);
        return back()->with('blog_status', 'New Blog Added');
    }
    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('theme.singleblog', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('theme.blogs.edit', compact('categories', 'blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }

    /**
     * Display all user blogs.
     */
    public function myBlogs(Blog $blog)
    {
        $blogs = Blog::where('user_id', Auth::user()->id)->paginate(3);
        return view('theme.blogs.my-blogs', compact('blogs'));
    }
}
