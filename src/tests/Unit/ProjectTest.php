<?php

namespace Tests\Unit;

use App\Models\Project;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    
    public function testAProjectHasAPath()
    {
        $project = Project::factory()->create();

        $this->assertEquals('/projects/'.$project->id,$project->path());
    }
}
