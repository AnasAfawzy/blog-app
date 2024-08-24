<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        if ($blog->user_id == Auth::user()->id) {
            $categories = Category::all();
            return view('theme.blogs.edit', compact('categories', 'blog'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if ($blog->user_id == Auth::user()->id) {
            $data = $request->validated();
            if ($request->hasFile('image')) {
                Storage::delete("public/blogs/$blog->image");
                $tempimage = $request->image;
                $image = time() . '_' . $tempimage->getClientOriginalName();
                $tempimage->storeAs('blogs', $image, 'public');
                $data['image'] = $image;
            }

            $blog->update($data);
            return back()->with('update_blog_status', 'Blog Updated');
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->user_id == Auth::user()->id) {
            Storage::delete("public/blogs/$blog->image");
            $blog->delete();
            return back()->with('delete_blog_status', 'Blog Deleted');
        }
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
