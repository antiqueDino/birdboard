<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */

    public function guests_cannot_manage_projects()
    {

        // $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');

    }

    /**
     * @test
     */

    public function a_user_can_create_a_project()
    {


        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'owner_id' => auth()->id(),
            'notes' => 'General notes here'
        ];

        $response = $this->post('/projects', $attributes);  

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    
    /**
     *
     * @test
     */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signIn();

        // $this->withoutExceptionHandling();

        $project = Project::factory()->create();
        
        $this->get($project->path())->assertStatus(403);
        
    }

    /**
     *
     * @test
     */
    public function an_authenticated_user_cannot_update_the_projects_of_others()
    {
        $this->signIn();

        // $this->withoutExceptionHandling();

        $project = Project::factory()->create();
        
        $this->patch($project->path())->assertStatus(403);
        
    }

    /**
     *
     * @test
     */
    public function a_project_requires_a_title()
    {
        
        $this->signIn();
        
        $attributes = Project::factory()->raw(['title' => '']);
        
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }
    
    /**
     *
     * @test
     */
    public function a_project_requires_a_description()
    {
        
        $this->signIn();
        

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }


    /**
     * @test
     */
    public function a_user_can_update_a_project() {

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes =  ['notes' => 'Changed'])
            ->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

    }

    /**
     * @test
     */

    public function a_user_can_view_their_project()
    {
        $project = ProjectFactory::create();


        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee(Str::limit($project->description, 100));
    }

}