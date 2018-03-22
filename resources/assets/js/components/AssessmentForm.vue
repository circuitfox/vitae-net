<template>
<div>
  <div v-if="edit || assessment.id == 0">
    <form class="form-horizontal" :action="route" :id="assessment" method="POST">
      <input type="hidden" name="_token" :value="csrfToken">
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="id" :value="assessment.id">
      <div class="form-group">
        <label class="col-md-4 control-label" for="student_name">Name:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="student_name" :value="assessment.student_name" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="date">Date:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="date" name="date" :value="assessment.date" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="start_time">Start time:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="start_time" :value="assessment.start_time" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="end_time">End time:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="end_time" :value="assessment.end_time" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="medical_record_number">Patient MRN:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="medical_record_number" :value="mrn" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="reason">Reason for admission:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="reason" :value="assessment.reason" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="temperature">Temperature:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="temperature" :value="assessment.temperature" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="bp_over">Blood pressure:</label>
        <div class="col-md-1">
          <input class="form-control" :form="assessment.id" type="text" name="bp_over" :value="assessment.bp_over" required>
        </div>
        <label class="col-md-1 control-label" for="bp_under" style="text-align:center;">/</label>
        <div class="col-md-1">
          <input class="form-control" :form="assessment.id" type="text" name="bp_under" :value="assessment.bp_under" required>
        </div>
        <div class="col-md-1">
          <label class="form-check-label" for="automatic">
            <input class="form-check-input" type="checkbox" name="automatic" value=1>Automatic?
          </label>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="apical_pulse">Apical pulse:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="apical_pulse" :value="assessment.apical_pulse" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="respiration">Respiration:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="respiration" :value="assessment.respiration" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="oximetry">Pulse oximetry:</label>
        <div class="col-md-3">
          <input class="form-control" :form="assessment.id" type="text" name="oximetry" :value="assessment.oximetry" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="allergies">Allergies:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="allergies" :value="assessment.allergies">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="loc">LOC:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="loc" :value="assessment.loc">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="orientation">Orientation:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="orientation" :value="assessment.orientation">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="speech">Speech:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="speech" :value="assessment.speech">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="behavior">Behavior/Mood/Affect:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="behavior" :value="assessment.behavior">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="memory">Memory:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="memory" :value="assessment.memory">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="pupillary">Pupillary response:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="pupillary" :value="assessment.pupillary">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="pain">Pain assessment/characteristics:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="pain" :value="assessment.pain">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="skincolor">Skin color:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="skincolor" :value="assessment.skincolor">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="skintemp">Skin temp/moisture:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="skintemp" :value="assessment.skintemp">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="hydration">Hydration/Turgor:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="hydration" :value="assessment.hydration">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="integrity">Skin integrity:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="integrity" :value="assessment.integrity">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="dressings">Dressings/Wounds:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="dressings" :value="assessment.dressings">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="ivsite">IV site(s)/Dressing, Saline lock or Continuous:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="ivsite" :value="assessment.ivsite">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="centrallines">Central lines/dressing:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="centrallines" :value="assessment.centrallines">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="heartrhythm">Heart Rhythm:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="heartrhythm" :value="assessment.heartrhythm">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="radial">Radial pulses (Rt. and Lt.):</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="radial" :value="assessment.radial">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="capillary">Capillary refill:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="capillary" :value="assessment.capillary">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="upper">Temperature/color of upper extremities:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="upper" :value="assessment.upper">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="breathrhythm">Breath sounds/rhythm:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="breathrhythm" :value="assessment.breathrhythm">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="cough">Breath sounds/cough:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="cough" :value="assessment.cough">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="secretions">Secretions/Sputum/Color:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="secretions" :value="assessment.secretions">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="roomair">Room air (or describe supplemental oxygen):</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="roomair" :value="assessment.roomair">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="nausea">Nausea/Vomiting/Tolerate Diet:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="nausea" :value="assessment.nausea">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="abdomen">Appearance of abdomen:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="abdomen" :value="assessment.abdomen">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="bowel">Bowel sounds:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="bowel" :value="assessment.bowel">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="stool">Stool characteristics/date of last BM:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="stool" :value="assessment.stool">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="tubefeeding">Tube feedings/Ostomy:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="tubefeeding" :value="assessment.tubefeeding">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="genitourinary">Continent/Incontinent/Foley, describe urine characteristics:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="genitourinary" :value="assessment.genitourinary">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="motion">Range of motion/mobility:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="motion" :value="assessment.motion">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="muscle">Muscle mass/strength:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="muscle" :value="assessment.muscle">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="pedal">Pedal pulses (Rt. and Lt.), D.P. and/or P.T., Femoral if applicable:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="pedal" :value="assessment.pedal">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="lower">Temp/color of lower extremities:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="lower" :value="assessment.lower">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="peripheral">Peripheral edema/Calf tenderness/pain/erythema:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="peripheral" :value="assessment.peripheral">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="ted">TED hose/SCD's:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="ted" :value="assessment.ted">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="restraints">Restraints/Casts:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="restraints" :value="assessment.restraints">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="drainage">Drainage/Drains:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="drainage" :value="assessment.drainage">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="activity">Activity-Bedrest/BRP/up with/without assistance:</label>
        <div class="col-md-6">
          <input class="form-control" :form="assessment.id" type="text" name="activity" :value="assessment.activity">
        </div>
      </div>
      <button :form="assessment.id" class="col-md-offset-6 col-md-3 btn btn-primary" type="submit">Submit</button>
    </form>
  </div>
  <div v-else>
    <div class="col-md-offset-2 col-md-5">
      <div>
        <h4><b><u>Name: </u></b></h4>
        <p>{{ assessment.student_name }}</p>
      </div>
      <div>
        <h4><b><u>Date: </u></b></h4>
        <p>{{ assessment.date }}</p>
      </div>
      <div>
        <h4><b><u>Start time: </u></b></h4>
        <p>{{ assessment.start_time }}</p>
      </div>
      <div>
        <h4><b><u>End time: </u></b></h4>
        <p>{{ assessment.end_time }}</p>
      </div>
      <div>
        <h4><b><u>Patient MRN: </u></b></h4>
        <p>{{ assessment.medical_record_number }}</p>
      </div>
      <div>
        <h4><b><u>Reason for admission: </u></b></h4>
        <p>{{ assessment.reason }}</p>
      </div>
      <div>
        <h4><b><u>Temperature: </u></b></h4>
        <p>{{ assessment.temperature }}</p>
      </div>
      <div>
        <h4><b><u>Blood pressure: </u></b></h4>
        <p>{{ assessment.bp_over }} / {{ assessment.bp_under }}</p>
      </div>
      <div>
        <h4><b><u>Automatic: </u></b></h4>
        <p>{{ assessment.automatic ? 'Yes' : 'No' }}</p>
      </div>
      <div>
        <h4><b><u>Apical pulse: </u></b></h4>
        <p>{{ assessment.apical_pulse }}</p>
      </div>
      <div>
        <h4><b><u>Respiration: </u></b></h4>
        <p>{{ assessment.respiration }}</p>
      </div>
      <div>
        <h4><b><u>Pulse oximetry: </u></b></h4>
        <p>{{ assessment.oximetry }}</p>
      </div>
      <div>
        <h4><b><u>Allergies: </u></b></h4>
        <p>{{ assessment.allergies }}</p>
      </div>
      <div>
        <h4><b><u>LOC: </u></b></h4>
        <p>{{ assessment.loc }}</p>
      </div>
      <div>
        <h4><b><u>Orientation: </u></b></h4>
        <p>{{ assessment.orientation }}</p>
      </div>
      <div>
        <h4><b><u>Speech: </u></b></h4>
        <p>{{ assessment.speech }}</p>
      </div>
      <div>
        <h4><b><u>Behavior/Mood/Affect: </u></b></h4>
        <p>{{ assessment.behavior }}</p>
      </div>
      <div>
        <h4><b><u>Memory: </u></b></h4>
        <p>{{ assessment.memory }}</p>
      </div>
      <div>
        <h4><b><u>Pupillary response: </u></b></h4>
        <p>{{ assessment.pupillary }}</p>
      </div>
      <div>
        <h4><b><u>Pain assessment/characteristics: </u></b></h4>
        <p>{{ assessment.pain }}</p>
      </div>
      <div>
        <h4><b><u>Skin color: </u></b></h4>
        <p>{{ assessment.skincolor }}</p>
      </div>
      <div>
        <h4><b><u>Skin temp/moisture: </u></b></h4>
        <p>{{ assessment.skintemp }}</p>
      </div>
      <div>
        <h4><b><u>Hydration/Turgor: </u></b></h4>
        <p>{{ assessment.hydration }}</p>
      </div>
      <div>
        <h4><b><u>Skin integrity: </u></b></h4>
        <p>{{ assessment.integrity }}</p>
      </div>
      <div>
        <h4><b><u>Dressings/Wounds: </u></b></h4>
        <p>{{ assessment.dressings }}</p>
      </div>
      <div>
        <h4><b><u>IV site(s)/Dressing, Saline lock or Continuous: </u></b></h4>
        <p>{{ assessment.ivsite }}</p>
      </div>
      <div>
        <h4><b><u>Central lines/dressing: </u></b></h4>
        <p>{{ assessment.centrallines }}</p>
      </div>
      <div>
        <h4><b><u>Heart Rhythm: </u></b></h4>
        <p>{{ assessment.heartrhythm }}</p>
      </div>
      <div>
        <h4><b><u>Radial pulses (Rt. and Lt.): </u></b></h4>
        <p>{{ assessment.radial }}</p>
      </div>
      <div>
        <h4><b><u>Capillary refill: </u></b></h4>
        <p>{{ assessment.capillary }}</p>
      </div>
      <div>
        <h4><b><u>Temperature/color of upper extremities: </u></b></h4>
        <p>{{ assessment.upper }}</p>
      </div>
      <div>
        <h4><b><u>Breath sounds/rhythm: </u></b></h4>
        <p>{{ assessment.breathrhythm }}</p>
      </div>
      <div>
        <h4><b><u>Breath sounds/cough: </u></b></h4>
        <p>{{ assessment.cough }}</p>
      </div>
      <div>
        <h4><b><u>Secretions/Sputum/Color: </u></b></h4>
        <p>{{ assessment.secretions }}</p>
      </div>
      <div>
        <h4><b><u>Room air (or describe supplemental oxygen): </u></b></h4>
        <p>{{ assessment.roomair }}</p>
      </div>
      <div>
        <h4><b><u>Nausea/Vomiting/Tolerate Diet: </u></b></h4>
        <p>{{ assessment.nausea }}</p>
      </div>
      <div>
        <h4><b><u>Appearance of abdomen: </u></b></h4>
        <p>{{ assessment.abdomen }}</p>
      </div>
      <div>
        <h4><b><u>Bowel sounds: </u></b></h4>
        <p>{{ assessment.bowel }}</p>
      </div>
      <div>
        <h4><b><u>Stool characteristics/date of last BM: </u></b></h4>
        <p>{{ assessment.stool }}</p>
      </div>
      <div>
        <h4><b><u>Tube feedings/Ostomy: </u></b></h4>
        <p>{{ assessment.tubefeeding }}</p>
      </div>
      <div>
        <h4><b><u>Continent/Incontinent/Foley, describe urine characteristics: </u></b></h4>
        <p>{{ assessment.genitourinary }}</p>
      </div>
      <div>
        <h4><b><u>Range of motion/mobility: </u></b></h4>
        <p>{{ assessment.motion }}</p>
      </div>
      <div>
        <h4><b><u>Muscle mass/strength: </u></b></h4>
        <p>{{ assessment.muscle }}</p>
      </div>
      <div>
        <h4><b><u>Pedal pulses (Rt. and Lt.), D.P. and/or P.T., Femoral if applicable: </u></b></h4>
        <p>{{ assessment.pedal }}</p>
      </div>
      <div>
        <h4><b><u>Temp/color of lower extremities: </u></b></h4>
        <p>{{ assessment.lower }}</p>
      </div>
      <div>
        <h4><b><u>Peripheral edema/Calf tenderness/pain/erythema: </u></b></h4>
        <p>{{ assessment.peripheral }}</p>
      </div>
      <div>
        <h4><b><u>TED hose/SCD's: </u></b></h4>
        <p>{{ assessment.ted }}</p>
      </div>
      <div>
        <h4><b><u>Restraints/Casts: </u></b></h4>
        <p>{{ assessment.restraints }}</p>
      </div>
      <div>
        <h4><b><u>Drainage/Drains: </u></b></h4>
        <p>{{ assessment.drainage }}</p>
      </div>
      <div>
        <h4><b><u>Activity-Bedrest/BRP/up with/without assistance: </u></b></h4>
        <p>{{ assessment.activity }}</p>
      </div>
      <button class="btn btn-primary col-md-3" @click="setEdit">Edit</button>
    </div>
  </div>
</div>
</template>

<script>
    export default {
        props: {
            assessment: {
                type: Object,
                required: true,
            },
            mrn: {
                type: String,
                required: true
            },
            route: {
                type: String,
                required: true
            },
        },
        data: function() {
            return {
                csrfToken: window.Laravel.csrfToken,
                edit: false,
            }
        },
        methods: {
            setEdit() {
                this.edit = true;
            },
        },
    }
</script>
