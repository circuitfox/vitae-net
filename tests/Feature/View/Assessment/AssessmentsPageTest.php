<?php

namespace Tests\Feature\View\Assessment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssessmentsPageTest extends TestCase
{
  use RefreshDatabase;

  public function testHasAssessment()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $assessment = factory(\App\Assessment::class)->create();
    $name =
      $this->faker_escape($assessment->patient->first_name . ' ' . $assessment->patient->last_name);
    $response = $this->actingAs($user)->get('/assessments/' . $assessment->medical_record_number);
    $response->assertSee('Assessments for ' . $name);
    $response->assertSee('<h5><b><u>Nurse:</u></b></h5>');
    $response->assertSee('<p>'. $this->faker_escape($assessment->student_name) .'</p>');
    $response->assertSee('<h5><b><u>Date:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->date . '</p>');
    $response->assertSee('<h5><b><u>Start time:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->start_time . '</p>');
    $response->assertSee('<h5><b><u>End time:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->end_time .'</p>');
    $response->assertSee('<h5><b><u>Patient MRN:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->medical_record_number .'</p>');
    $response->assertSee('<h5><b><u>Reason for admission:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->reason .'</p>');
    $response->assertSee('<h5><b><u>Temperature:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->temperature .'</p>');
    $response->assertSee('<h5><b><u>Blood pressure:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->bp_over . ' / ' . $assessment->bp_under .'</p>');
    $response->assertSee('<h5><b><u>Automatic:</u></b></h5>');
    $response->assertSee('<p>'. ($assessment->automatic ? 'Yes': 'No') .'</p>');
    $response->assertSee('<h5><b><u>Apical pulse:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->apical_pulse .'</p>');
    $response->assertSee('<h5><b><u>Respiration:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->respiration .'</p>');
    $response->assertSee('<h5><b><u>Pulse oximetry:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->oximetry .'</p>');
    $response->assertSee('<h5><b><u>Allergies:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->allergies .'</p>');
    $response->assertSee('<h5><b><u>LOC:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->loc .'</p>');
    $response->assertSee('<h5><b><u>Orientation:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->orientation .'</p>');
    $response->assertSee('<h5><b><u>Speech:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->speech .'</p>');
    $response->assertSee('<h5><b><u>Behavior/Mood/Affect:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->behavior .'</p>');
    $response->assertSee('<h5><b><u>Memory:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->memory .'</p>');
    $response->assertSee('<h5><b><u>Pupillary response:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->pupillary .'</p>');
    $response->assertSee('<h5><b><u>Pupil size:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->pupil_size . '</p>');
    $response->assertSee('<h5><b><u>Pupil shape:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->pupil_shape . '</p>');
    $response->assertSee('<h5><b><u>Accommodation:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->accommodation . '</p>');
    $response->assertSee('<h5><b><u>Pain Scale:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->pain_scale . '</p>');
    $response->assertSee('<h5><b><u>Pain Location:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->pain_location . '</p>');
    $response->assertSee('<h5><b><u>Skin color:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->skincolor .'</p>');
    $response->assertSee('<h5><b><u>Skin temp/moisture:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->skintemp .'</p>');
    $response->assertSee('<h5><b><u>Hydration/Turgor:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->hydration .'</p>');
    $response->assertSee('<h5><b><u>Skin integrity:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->integrity .'</p>');
    $response->assertSee('<h5><b><u>Dressings/Wounds:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->dressings .'</p>');
    $response->assertSee('<h5><b><u>IV site(s)/Dressing, Saline lock or Continuous:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->ivsite .'</p>');
    $response->assertSee('<h5><b><u>Central lines/dressing:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->centrallines .'</p>');
    $response->assertSee('<h5><b><u>Heart Rhythm:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->heartrhythm .'</p>');
    $response->assertSee('<h5><b><u>Radial pulses (Rt. and Lt.):</u></b></h5>');
    $response->assertSee('<p>'. $assessment->radial .'</p>');
    $response->assertSee('<h5><b><u>Capillary refill:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->capillary .'</p>');
    $response->assertSee('<h5><b><u>Temperature/color of upper right extremity:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->right_upper . '</p>');
    $response->assertSee('<h5><b><u>Temperature/color of upper left extremity:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->left_upper . '</p>');
    $response->assertSee('<h5><b><u>Right breath sounds/rhythm:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->right_breath . '</p>');
    $response->assertSee('<h5><b><u>Left breath sounds/rhythm:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->left_breath . '</p>');
    $response->assertSee('<h5><b><u>Cough:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->cough .'</p>');
    $response->assertSee('<h5><b><u>Secretions/Sputum/Color:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->secretions .'</p>');
    $response->assertSee('<h5><b><u>Supplemental oxygen:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->supplemental . '</p>');
    $response->assertSee('<h5><b><u>Liters/Minute of Oxygen:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->liters_per_minute . '</p>');
    $response->assertSee('<h5><b><u>Diet:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->diet . '</p>');
    $response->assertSee('<h5><b><u>Appearance of abdomen:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->abdomen .'</p>');
    $response->assertSee('<h5><b><u>Bowel sounds:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->bowel .'</p>');
    $response->assertSee('<h5><b><u>Stool characteristics/date of last BM:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->stool .'</p>');
    $response->assertSee('<h5><b><u>Tube feedings/Ostomy:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->tubefeeding .'</p>');
    $response->assertSee('<h5><b><u>Continent/Incontinent/Foley, describe urine characteristics:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->genitourinary .'</p>');
    $response->assertSee('<h5><b><u>Urine characteristics:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->urine . '</p>');
    $response->assertSee('<h5><b><u>Range of motion/mobility:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->motion .'</p>');
    $response->assertSee('<h5><b><u>Muscle mass/strength:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->muscle .'</p>');
    $response->assertSee('<h5><b><u>Right pedal pulse, D.P. and/or P.T., Femoral if applicable:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->right_pedal . '</p>');
    $response->assertSee('<h5><b><u>Left pedal pulse, D.P. and/or P.T., Femoral if applicable:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->left_pedal . '</p>');
    $response->assertSee('<h5><b><u>Temp/color of right lower extremity:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->right_lower . '</p>');
    $response->assertSee('<h5><b><u>Temp/color of left lower extremity:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->left_lower . '</p>');
    $response->assertSee('<h5><b><u>Peripheral edema:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->peripheral .'</p>');
    $response->assertSee('<h5><b><u>Calf tenderness/pain/erythema:</u></b></h5>');
    $response->assertSee('<p>' . $assessment->calf . '</p>');
    $response->assertSee("<h5><b><u>TED hose/SCD's:</u></b></h5>");
    $response->assertSee('<p>'. $assessment->ted .'</p>');
    $response->assertSee('<h5><b><u>Drainage/Drains:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->drainage .'</p>');
    $response->assertSee('<h5><b><u>Activity-Bedrest/BRP/up with/without assistance:</u></b></h5>');
    $response->assertSee('<p>'. $assessment->activity .'</p>');
  }

  public function testHasMessageIfEmpty()
  {
    $user = factory(\App\User::class)->states('admin')->create();
    $patient = factory(\App\Patient::class)->create();
    $name = $this->faker_escape($patient->first_name . ' ' . $patient->last_name);
    $response = $this->actingAs($user)->get('/assessments/' . $patient->medical_record_number);
    $response->assertSee('No assessments for ' . $name);
  }
}
