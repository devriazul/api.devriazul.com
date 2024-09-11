<?php

namespace App\Http\Controllers;
use App\Models\Blog;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Show all blogs
    public function index()
    {
        $blogs = Blog::all();
        return response()->json($blogs);
    }

    // Show a single blog by slug
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return response()->json($blog);
    }

    // Create a new blog
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required|unique:blogs',
            'image' => 'nullable|image'
        ]);

        $blog = Blog::create($request->all());
        return response()->json($blog, 201);
    }

    // Update a blog
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->all());
        return response()->json($blog);
    }

    // Delete a blog
    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

