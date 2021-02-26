    @csrf
    
    <div class="field">
        <label for="title" class="label text-sm mb-2 block">Title</label>

        <div class="control">
            <input 
                type="text" 
                class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full" 
                name="title" 
                placeholder="My next awesome project"
                value="{{ $project->title }}"
                required>
        </div>
    </div>

    <div class="field mb-6">
        <label for="description" class="label text-sm mb-2 block">Description</label>

        <div class="control">
            <textarea 
                type="text" 
                class="textarea bg-transparent border border-grey-light rounded p-2 text-xs w-full" 
                name="description"
                required>{{ $project->description }}</textarea>
        </div>
    </div>

    <div class="field">
        <div class="control">
            <button type="submit" class="button-is-link" >{{ $buttonText }}</button>
            <a href="{{ $project->path() }}">Cancel</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="field mt-6">
            @foreach ($errors->all() as $error)
                <li class="text-sm text-red-600">{{ $error }}</li>
            @endforeach
        </div>
    @endif