<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Projects;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Projects::all();
        return view('dashboard.projects.index', ['projects' => $projects]);
    }

    public function create()
    {
        return view('dashboard.projects.create');
    }

    public function show($slug)
    {
        $project = Projects::where('slug', $slug)->firstOrFail();
        return view('dashboard.projects.show', ['project' => $project]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required', // Ensure you're using the right field name in your form
            'slug' => 'required|unique:projects',
            'image' => 'nullable|image',
        ]);

        $data = $request->only(['title', 'content', 'slug']); // Include 'content'

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Projects::create($data);

        return redirect()->route('dashboard.projects.index');
    }

    public function edit($id)
    {
        $project = Projects::findOrFail($id);
        return view('dashboard.projects.edit', ['project' => $project]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required', // Ensure you're validating the correct field
            'slug' => 'required|unique:projects,slug,' . $id,
            'image' => 'nullable|image',
        ]);

        $project = Projects::findOrFail($id);
        $data = $request->only(['title', 'content', 'slug']); // Include 'content'

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($project->image) {
                \Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $project->update($data);

        return redirect()->route('dashboard.projects.index');
    }

    public function destroy($id)
    {
        $project = Projects::findOrFail($id);

        // Delete the image if it exists
        if ($project->image) {
            \Storage::disk('public')->delete($project->image);
        }

        $project->delete();
        return redirect()->route('dashboard.projects.index');
    }
}
