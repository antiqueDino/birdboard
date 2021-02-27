@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="flex justify-between items-center py-2">
                        {{ __('You are logged in!') }}

                        <a href="/projects" class="bg-blue-500 rounded-md font-bold text-white text-center py-1 px-2  my-8 justifiy-end transition duration-300 ease-in-out hover:bg-blue-600 mr-2">
                            My Projects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
