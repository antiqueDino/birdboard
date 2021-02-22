<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects', ));
    }

    public function show(Project $project)
    {
        // $project = Project::find($request->project);

        if(auth()->user()->isNot($project->owner)){
            abort(403);
        }


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
