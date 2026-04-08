<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.form', ['project' => new Project()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number'      => 'required|string|max:5',
            'tag'         => 'required|string|max:100',
            'title'       => 'required|string|max:150',
            'description' => 'required|string',
            'stack'       => 'required|string',   // comma-separated
            'link'        => 'nullable|url|max:255',
            'bg_image'    => 'nullable|url|max:500',
            'sort_order'  => 'integer',
        ]);

        $data['link'] = $data['link'] ?? '#';
        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project added!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'number'      => 'required|string|max:5',
            'tag'         => 'required|string|max:100',
            'title'       => 'required|string|max:150',
            'description' => 'required|string',
            'stack'       => 'required|string',
            'link'        => 'nullable|url|max:255',
            'bg_image'    => 'nullable|url|max:500',
            'sort_order'  => 'integer',
        ]);

        $data['link'] = $data['link'] ?? '#';
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted!');
    }
}
