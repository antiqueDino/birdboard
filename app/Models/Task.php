<?php

namespace App\Models;

use App\Models\Activity;
use App\Models\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    use RecordsActivity;

    protected $guarded = [];


    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];

    protected static $recordableEvents = ['created', 'deleted'];

    public function complete()
    {
        $this->update(['completed' => true]);

        $this->recordActivity('completed_task');

    }

    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->recordActivity('incompleted_task');

    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function path(){
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

}
