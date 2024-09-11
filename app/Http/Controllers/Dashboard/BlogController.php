<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('dashboard.blogs.index', ['blogs' => $blogs]);
    }

    public function create()
    {
        return view('dashboard.blogs.create');
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('dashboard.blogs.show', ['blog' => $blog]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required|unique:blogs',
            'image' => 'nullable|image'
        ]);

        $data = $request->only(['title', 'content', 'slug']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Blog::create($data);

        return redirect()->route('dashboard.blogs.index');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('dashboard.blogs.edit', ['blog' => $blog]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'required|unique:blogs,slug,' . $id,
            'image' => 'nullable|image'
        ]);

        $blog = Blog::findOrFail($id);
        $data = $request->only(['title', 'content', 'slug']);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($blog->image) {
                \Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $blog->update($data);

        return redirect()->route('dashboard.blogs.index');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // Delete the image if it exists
        if ($blog->image) {
            \Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();
        return redirect()->route('dashboard.blogs.index');
    }
}
