@extends('layouts.app')
@section('content')

    <header class="flex items-center mb-3 pb-4"> 
        <div class="flex justify-between items-end w-full">

            <p class="text-default text-sm font-normal">
                <a href="/projects" class="text-blue-400 text-sm font-normal no-underline hover:underline">My Projects</a> / {{ $project->title }}
            </p>   

            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img src="{{ gravatar_url($member->email ) }}" alt="{{ $member->name }}'s avatar" class="rounded-full w-8 mr-2">
                @endforeach

                <img src="{{ gravatar_url($project->owner->email ) }}" alt="{{ $project->owner->name }}'s avatar" class="rounded-full w-8 mr-2">

                <a href="{{ $project->path().'/edit' }}" class="button text-white no-underline rounded-lg shadow-lg text-sm py-2 px-5 ml-4">Edit Project</a>
            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3 ">
            <div class="lg:w-3/4 px-3 mb-8">
                
                <div class="mb-6">
                    <h2 class="text-xl text-default font-normal mb-3">Tasks</h2>   
                    {{-- tasks --}}

                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="POST" action="{{ $task->path() }}" >
                                @method('PATCH')
                                @csrf

                                <div class="flex">
                                    <input name="body" value="{{ $task->body }}" class="bg-card text-default w-full {{ $task->completed ? 'text-default' : ''}}">
                                    <input name="completed" type="checkbox" onChange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input class="w-full bg-card text-default" placeholder="Add new task" name="body">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl text-default font-normal">General Notes</h2>   

                    {{-- general notes --}}
                    <form action="{{ $project->path() }}" method="post">
                        @csrf
                        @method('PATCH')

                        <textarea 
                            name="notes"
                            class="card w-full" 
                            style="min-height: 200px" 
                            placeholder="Anything special that you want to make  note of?"
                        >{{ $project->notes }}</textarea>

                        <button type="submit" class="button text-white no-underline rounded-lg shadow-lg text-sm py-2 px-5">Save</button>
                    </form>

                    @include('errors')

                </div>

            </div>

            <div class="lg:w-1/4 px-3">
                @include('projects.card')
                @include('projects.activity.card')

                @can('manage', $project)
                    @include('projects.invite')
                @endcan

            </div>

        </div>
    </main>

    

@endsection