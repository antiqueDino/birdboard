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

    public function store(Request $request)
    {
        // validated

        $attributes = $request->validate(['title' => 'required', 'description' => 'required']); 

        // persisted
        Project::create($attributes);

        //redirect

        return redirect('/projects');
    }
}
