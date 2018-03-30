<?php

namespace Tests\Feature\Table;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsTableTest extends TestCase
{
    use DatabaseMigrations;

    public function testHasAssessmentsTable()
    {
        $this->assertTrue(Schema::hasTable('assessments'));
    }

    public function testHasIdColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'id'));
    }

    public function testHasStudentNameColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'student_name'));
    }

    public function testHasDateColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'date'));
    }

    public function testHasStartTimeColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'start_time'));
    }

    public function testHasEndTimeColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'end_time'));
    }

    public function testHasMedicalRecordNumberColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'medical_record_number'));
    }

    public function testHasReasonColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'reason'));
    }

    public function testHasTemperatureColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'temperature'));
    }

    public function testHasBpOverColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'bp_over'));
    }

    public function testHasBpUnderColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'bp_under'));
    }

    public function testHasApicalPulseColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'apical_pulse'));
    }

    public function testHasRespirationColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'respiration'));
    }

    public function testHasOximetryColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'oximetry'));
    }

    public function testHasAutomaticColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'automatic'));
    }

    public function testHasAllergiesColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'allergies'));
    }

    public function testHasLocColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'loc'));
    }

    public function testHasOrientationColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'orientation'));
    }

    public function testHasSpeechColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'speech'));
    }

    public function testHasBehaviorColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'behavior'));
    }

    public function testHasMemoryColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'memory'));
    }

    public function testHasPupillaryColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'pupillary'));
    }

    public function testHasPainColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'pain'));
    }

    public function testHasSkincolorColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'skincolor'));
    }

    public function testHasSkintempColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'skintemp'));
    }

    public function testHasHydrationColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'hydration'));
    }

    public function testHasIntegrityColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'integrity'));
    }

    public function testHasDressingsColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'dressings'));
    }

    public function testHasIvsiteColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'ivsite'));
    }

    public function testHasCentrallinesColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'centrallines'));
    }

    public function testHasHeartrhythmColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'heartrhythm'));
    }

    public function testHasRadialColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'radial'));
    }

    public function testHasCapillaryColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'capillary'));
    }

    public function testHasUpperColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'upper'));
    }

    public function testHasBreathrhythmColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'breathrhythm'));
    }

    public function testHasCoughColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'cough'));
    }

    public function testHasSecretionsColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'secretions'));
    }

    public function testHasRoomairColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'roomair'));
    }

    public function testHasNauseaColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'nausea'));
    }

    public function testHasAbdomenColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'abdomen'));
    }

    public function testHasBowelColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'bowel'));
    }

    public function testHasStoolColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'stool'));
    }

    public function testHasTubefeedingColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'tubefeeding'));
    }

    public function testHasGenitourinaryColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'genitourinary'));
    }

    public function testHasMotionColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'motion'));
    }

    public function testHasMuscleColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'muscle'));
    }

    public function testHasPedalColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'pedal'));
    }

    public function testHasLowerColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'lower'));
    }

    public function testHasPeripheralColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'peripheral'));
    }

    public function testHasTedColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'ted'));
    }

    public function testHasRestraintsColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'restraints'));
    }

    public function testHasDrainageColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'drainage'));
    }

    public function testHasActivityColumn()
    {
        $this->assertTrue(Schema::hasColumn('assessments', 'activity'));
    }
}
