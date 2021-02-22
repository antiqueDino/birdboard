<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects', ));
    }

    public function show(Project $project)
    {
        // $project = Project::find($request->project);

        return view('projects.show', compact('project'));
    }

    public function store(Request $request)
    {

        // validated

        $attributes = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'owner_id' => 'required'
        ]); 

        // $attributes['owner_id'] = auth()->id();

        auth()->user()->projects()->create($attributes);

        return redirect('/projects');
    }
}
