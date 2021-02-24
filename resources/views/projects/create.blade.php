@extends('layouts.app')
@section('content')

    <form action="/projects" method="POST">
        @csrf

        <h1 class="heading is-1">Create a project</h1>
        
        <div class="field">
            <label for="title" class="label">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" plceholer="">
            </div>
        </div>

        <div class="field">
            <label for="description" class="label">Description</label>

            <div class="control">
                <textarea type="text" class="textarea" name="description"></textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button-is-link" >Create</button>
                <a href="/projects">Cancel</a>
            </div>
        </div>
    </form>    

@endsection
