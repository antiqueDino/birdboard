<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectTest extends TestCase
{

    use RefreshDatabase;
    use HasFactory;
    /**
     * @test
     * 
     */

    public function it_has_a_path()
    {
        $project = Project::factory()->create();

        $this->assertEquals('/projects/'.$project->id, $project->path());
    }

    /**
     * @test
     */

    public function it_belongs_to_an_owner()
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf(User::class, $project->owner);
    }
}