<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Show all projects
    public function index()
    {
        $projects = Projects::all();
        return response()->json($projects);
    }

    // Show a single project by slug
    public function show($slug)
    {
        $project = Projects::where('slug', $slug)->firstOrFail();
        return response()->json($project);
    }

    // Create a new project
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'slug' => 'required|unique:projects',
            'image' => 'nullable|image',
            'url' => 'nullable|url'  // Assuming projects might have an associated URL
        ]);

        $project = Projects::create($request->all());
        return response()->json($project, 201);
    }

    // Update a project
    public function update(Request $request, $id)
    {
        $project = Projects::findOrFail($id);
        $project->update($request->all());
        return response()->json($project);
    }

    // Delete a project
    public function destroy($id)
    {
        Projects::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
