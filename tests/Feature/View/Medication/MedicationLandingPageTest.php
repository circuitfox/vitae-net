<?php

namespace Tests\Feature\View\Medication;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicationLandingPageTest extends TestCase
{
    function testHasPanel()
    {
        $response = $this->get('/medication');
        $response->assertSee('<div class="panel-heading"><h3>Students:</h3></div>');
        $response->assertSee('<div class="panel-body">');
        $response->assertSee('Instructions for using the medication scanning system:');
        $response->assertSee('<li>Scan a patient\'s bracelet</li>');
        $response->assertSee('<li>Scan medication that needs to be administered</li>');
        $response->assertSee('<li>Complete the summary form</li>');
        $response->assertSee('<li>Sign and accept the summary form</li>');
        $response->assertSee('<a class="btn btn-primary" href="' . url('/scan') . '">Begin</a>');
    }
}
