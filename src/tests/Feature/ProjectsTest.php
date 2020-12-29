<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testAUserCanCreateAProject(){
        // $this->withoutExceptionHandling();
        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']); 

    }

    public function testAProjectRequiresATitle(){
        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');

    }

    public function testAProjectRequiresADescription(){
        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');

    }

    public function testAUserCanViewAProject(){
        $this->withoutExceptionHandling();
        $project = Project::factory()->create();

        $this->get('/projects/'.$project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);

    }
}
