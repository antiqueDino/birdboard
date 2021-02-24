@extends('layouts.app')
@section('content')

    <header class="flex items-center mb-3 py-4"> 
        <div class="flex justify-between items-center w-full">

            <p class="text-gray-400 text-sm">
                <a href="/projects" class="text-blue-400 text-sm no-underline">My Projects</a> / {{ $project->title }}
            </p>   
            <a href="{{ $project->path().'/edit' }}" class="button text-white no-underline rounded-lg shadow-lg text-sm py-2 px-5">Edit Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3 ">
            <div class="lg:w-3/4 px-3 mb-8">
                
                <div class="mb-6">
                    <h2 class="text-xl text-gray-400 font-normal mb-3">Tasks</h2>   
                    {{-- tasks --}}

                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="POST" action="{{ $task->path() }}" >
                                @method('PATCH')
                                @csrf

                                <div class="flex">
                                    <input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-gray-400' : ''}}">
                                    <input name="completed" type="checkbox" onChange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input class="w-full" placeholder="Add new task" name="body">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl text-gray-400 font-normal">General Notes</h2>   

                    {{-- general notes --}}
                    <form action="{{ $project->path() }}" method="post">
                        @csrf
                        @method('PATCH')

                        <textarea 
                            name="notes"
                            class="card w-full" 
                            style="min-height: 200px" 
                            placeholder="Anything special that you want to make  note of?"
                        > {{ $project->notes }} </textarea>

                        <button type="submit" class="button text-white no-underline rounded-lg shadow-lg text-sm py-2 px-5">Save</button>
                    </form>

                    @if ($errors->any())
                        <div class="field mt-6">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm text-red-600">{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

                </div>

            </div>

            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>

        </div>
    </main>

    

@endsection