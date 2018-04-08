<div class="row">
  <h4 class="text-center">
    <strong>{{ $assessment['start_time'] }} - {{ $assessment['end_time'] }}</strong>
  </h4>
</div>
<hr>
<div class="row">
  <h5><b><u>Nurse:</u></b></h5>
  <p>{{ $assessment['student_name'] }}</p>
</div>
<div class="row">
  <h5><b><u>Date:</u></b></h5>
  <p>{{ $assessment['date'] }}</p>
</div>
<div class="row">
  <h5><b><u>Start time:</u></b></h5>
  <p>{{ $assessment['start_time'] }}</p>
</div>
<div class="row">
  <h5><b><u>End time:</u></b></h5>
  <p>{{ $assessment['end_time'] }}</p>
</div>
<div class="row">
  <h5><b><u>Patient MRN:</u></b></h5>
  <p>{{ $assessment['medical_record_number'] }}</p>
</div>
<div class="row">
  <h5><b><u>Reason for admission:</u></b></h5>
  <p>{{ $assessment['reason'] }}</p>
</div>
<div class="row">
  <h5><b><u>Temperature:</u></b></h5>
  <p>{{ $assessment['temperature'] }}</p>
</div>
<div class="row">
  <h5><b><u>Blood pressure:</u></b></h5>
  <p>{{ $assessment['bp_over'] }} / {{ $assessment['bp_under'] }}</p>
</div>
<div class="row">
  <h5><b><u>Automatic:</u></b></h5>
  <p>{{ $assessment['automatic'] ? 'Yes' : 'No' }}</p>
</div>
<div class="row">
  <h5><b><u>Apical pulse:</u></b></h5>
  <p>{{ $assessment['apical_pulse'] }}</p>
</div>
<div class="row">
  <h5><b><u>Respiration:</u></b></h5>
  <p>{{ $assessment['respiration'] }}</p>
</div>
<div class="row">
  <h5><b><u>Pulse oximetry:</u></b></h5>
  <p>{{ $assessment['oximetry'] }}</p>
</div>
<div class="row">
  <h5><b><u>Allergies:</u></b></h5>
  <p>{{ $assessment['allergies'] }}</p>
</div>
<div class="row">
  <h5><b><u>LOC:</u></b></h5>
  <p>{{ $assessment['loc'] }}</p>
</div>
<div class="row">
  <h5><b><u>Orientation:</u></b></h5>
  <p>{{ $assessment['orientation'] }}</p>
</div>
<div class="row">
  <h5><b><u>Speech:</u></b></h5>
  <p>{{ $assessment['speech'] }}</p>
</div>
<div class="row">
  <h5><b><u>Behavior/Mood/Affect:</u></b></h5>
  <p>{{ $assessment['behavior'] }}</p>
</div>
<div class="row">
  <h5><b><u>Memory:</u></b></h5>
  <p>{{ $assessment['memory'] }}</p>
</div>
<div class="row">
  <h5><b><u>Pupillary response:</u></b></h5>
  <p>{{ $assessment['pupillary'] }}</p>
</div>
<div class="row">
  <h5><b><u>Pain assessment/characteristics:</u></b></h5>
  <p>{{ $assessment['pain'] }}</p>
</div>
<div class="row">
  <h5><b><u>Skin color:</u></b></h5>
  <p>{{ $assessment['skincolor'] }}</p>
</div>
<div class="row">
  <h5><b><u>Skin temp/moisture:</u></b></h5>
  <p>{{ $assessment['skintemp'] }}</p>
</div>
<div class="row">
  <h5><b><u>Hydration/Turgor:</u></b></h5>
  <p>{{ $assessment['hydration'] }}</p>
</div>
<div class="row">
  <h5><b><u>Skin integrity:</u></b></h5>
  <p>{{ $assessment['integrity'] }}</p>
</div>
<div class="row">
  <h5><b><u>Dressings/Wounds:</u></b></h5>
  <p>{{ $assessment['dressings'] }}</p>
</div>
<div class="row">
  <h5><b><u>IV site(s)/Dressing, Saline lock or Continuous:</u></b></h5>
  <p>{{ $assessment['ivsite'] }}</p>
</div>
<div class="row">
  <h5><b><u>Central lines/dressing:</u></b></h5>
  <p>{{ $assessment['centrallines'] }}</p>
</div>
<div class="row">
  <h5><b><u>Heart Rhythm:</u></b></h5>
  <p>{{ $assessment['heartrhythm'] }}</p>
</div>
<div class="row">
  <h5><b><u>Radial pulses (Rt. and Lt.):</u></b></h5>
  <p>{{ $assessment['radial'] }}</p>
</div>
<div class="row">
  <h5><b><u>Capillary refill:</u></b></h5>
  <p>{{ $assessment['capillary'] }}</p>
</div>
<div class="row">
  <h5><b><u>Temperature/color of upper extremities:</u></b></h5>
  <p>{{ $assessment['upper'] }}</p>
</div>
<div class="row">
  <h5><b><u>Breath sounds/rhythm:</u></b></h5>
  <p>{{ $assessment['breathrhythm'] }}</p>
</div>
<div class="row">
  <h5><b><u>Breath sounds/cough:</u></b></h5>
  <p>{{ $assessment['cough'] }}</p>
</div>
<div class="row">
  <h5><b><u>Secretions/Sputum/Color:</u></b></h5>
  <p>{{ $assessment['secretions'] }}</p>
</div>
<div class="row">
  <h5><b><u>Room air (or describe supplemental oxygen):</u></b></h5>
  <p>{{ $assessment['roomair'] }}</p>
</div>
<div class="row">
  <h5><b><u>Nausea/Vomiting/Tolerate Diet:</u></b></h5>
  <p>{{ $assessment['nausea'] }}</p>
</div>
<div class="row">
  <h5><b><u>Appearance of abdomen:</u></b></h5>
  <p>{{ $assessment['abdomen'] }}</p>
</div>
<div class="row">
  <h5><b><u>Bowel sounds:</u></b></h5>
  <p>{{ $assessment['bowel'] }}</p>
</div>
<div class="row">
  <h5><b><u>Stool characteristics/date of last BM:</u></b></h5>
  <p>{{ $assessment['stool'] }}</p>
</div>
<div class="row">
  <h5><b><u>Tube feedings/Ostomy:</u></b></h5>
  <p>{{ $assessment['tubefeeding'] }}</p>
</div>
<div class="row">
  <h5><b><u>Continent/Incontinent/Foley, describe urine characteristics:</u></b></h5>
  <p>{{ $assessment['genitourinary'] }}</p>
</div>
<div class="row">
  <h5><b><u>Range of motion/mobility:</u></b></h5>
  <p>{{ $assessment['motion'] }}</p>
</div>
<div class="row">
  <h5><b><u>Muscle mass/strength:</u></b></h5>
  <p>{{ $assessment['muscle'] }}</p>
</div>
<div class="row">
  <h5><b><u>Pedal pulses (Rt. and Lt.), D.P. and/or P.T., Femoral if applicable:</u></b></h5>
  <p>{{ $assessment['pedal'] }}</p>
</div>
<div class="row">
  <h5><b><u>Temp/color of lower extremities:</u></b></h5>
  <p>{{ $assessment['lower'] }}</p>
</div>
<div class="row">
  <h5><b><u>Peripheral edema/Calf tenderness/pain/erythema:</u></b></h5>
  <p>{{ $assessment['peripheral'] }}</p>
</div>
<div class="row">
  <h5><b><u>TED hose/SCD's:</u></b></h5>
  <p>{{ $assessment['ted'] }}</p>
</div>
<div class="row">
  <h5><b><u>Restraints/Casts:</u></b></h5>
  <p>{{ $assessment['restraints'] }}</p>
</div>
<div class="row">
  <h5><b><u>Drainage/Drains:</u></b></h5>
  <p>{{ $assessment['drainage'] }}</p>
</div>
<div class="row">
  <h5><b><u>Activity-Bedrest/BRP/up with/without assistance:</u></b></h5>
  <p>{{ $assessment['activity'] }}</p>
</div>
