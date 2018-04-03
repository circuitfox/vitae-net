<template>
<div>
  <div v-if="edit || assessment.id == 0">
    <form class="form-horizontal" :action="route" :id="assessment" method="POST">
      <input type="hidden" name="_token" :value="csrfToken">
      <input type="hidden" name="id" :value="assessment.id">
      <div class="form-group">
        <label class="col-md-4 control-label" for="student_name">Name:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="student_name" :value="assessment.student_name" required>
          <span class="help-block" v-if="errors['student_name']">
            {{ errors['student_name'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="date">Date:</label>
        <div class="col-md-6">
          <input class="form-control" type="date" name="date" :value="assessment.date" required>
          <span class="help-block" v-if="errors['date']">
            {{ errors['date'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="start_time">Start time:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="start_time" :value="assessment.start_time" required>
          <span class="help-block" v-if="errors['start_time']">
            {{ errors['start_time'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="end_time">End time:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="end_time" :value="assessment.end_time" required>
          <span class="help-block" v-if="errors['end_time']">
            {{ errors['end_time'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="medical_record_number">Patient MRN:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="medical_record_number" :value="mrn" required>
          <span class="help-block" v-if="errors['medical_record_number']">
            {{ errors['medical_record_number'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="reason">Reason for admission:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="reason" :value="assessment.reason" required>
          <span class="help-block" v-if="errors['reason']">
            {{ errors['reason'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="temperature">Temperature:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="temperature" :value="assessment.temperature" required>
          <span class="help-block" v-if="errors['temperature']">
            {{ errors['temperature'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="bp_over">Blood pressure:</label>
        <div class="col-md-1">
          <input class="form-control" type="text" name="bp_over" :value="assessment.bp_over" required>
          <span class="help-block" v-if="errors['bp_over']">
            {{ errors['bp_over'][0] }}
          </span>
        </div>
        <label class="col-md-1 control-label" for="bp_under" style="text-align:center;">/</label>
        <div class="col-md-1">
          <input class="form-control" type="text" name="bp_under" :value="assessment.bp_under" required>
          <span class="help-block" v-if="errors['bp_under']">
            {{ errors['bp_under'][0] }}
          </span>
        </div>
        <div class="col-md-1">
          <label class="form-check-label" for="automatic">
            <input class="form-check-input" type="checkbox" name="automatic" value=1>Automatic?
          </label>
          <span class="help-block" v-if="errors['automatic']">
            {{ errors['automatic'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="apical_pulse">Apical pulse:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="apical_pulse" :value="assessment.apical_pulse" required>
          <span class="help-block" v-if="errors['apical_pulse']">
            {{ errors['apical_pulse'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="respiration">Respiration:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="respiration" :value="assessment.respiration" required>
          <span class="help-block" v-if="errors['registration']">
            {{ errors['registration'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="oximetry">Pulse oximetry:</label>
        <div class="col-md-3">
          <input class="form-control" type="text" name="oximetry" :value="assessment.oximetry" required>
          <span class="help-block" v-if="errors['oximetry']">
            {{ errors['oximetry'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="allergies">Allergies:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="allergies" :value="assessment.allergies">
          <span class="help-block" v-if="errors['allergies']">
            {{ errors['allergies'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="loc">LOC:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="loc" :value="assessment.loc">
          <span class="help-block" v-if="errors['loc']">
            {{ errors['loc'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="orientation">Orientation:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="orientation" :value="assessment.orientation">
          <span class="help-block" v-if="errors['orientation']">
            {{ errors['orientation'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="speech">Speech:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="speech" :value="assessment.speech">
          <span class="help-block" v-if="errors['speech']">
            {{ errors['speech'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="behavior">Behavior/Mood/Affect:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="behavior" :value="assessment.behavior">
          <span class="help-block" v-if="errors['behavior']">
            {{ errors['behavior'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="memory">Memory:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="memory" :value="assessment.memory">
          <span class="help-block" v-if="errors['memory']">
            {{ errors['memory'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="pupillary">Pupillary response:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="pupillary" :value="assessment.pupillary">
          <span class="help-block" v-if="errors['pupillary']">
            {{ errors['pupillary'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="pain">Pain assessment/characteristics:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="pain" :value="assessment.pain">
          <span class="help-block" v-if="errors['pain']">
            {{ errors['pain'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="skincolor">Skin color:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="skincolor" :value="assessment.skincolor">
          <span class="help-block" v-if="errors['skincolor']">
            {{ errors['skincolor'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="skintemp">Skin temp/moisture:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="skintemp" :value="assessment.skintemp">
          <span class="help-block" v-if="errors['skintemp']">
            {{ errors['skintemp'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="hydration">Hydration/Turgor:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="hydration" :value="assessment.hydration">
          <span class="help-block" v-if="errors['hydration']">
            {{ errors['hydration'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="integrity">Skin integrity:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="integrity" :value="assessment.integrity">
          <span class="help-block" v-if="errors['integrity']">
            {{ errors['integrity'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="dressings">Dressings/Wounds:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="dressings" :value="assessment.dressings">
          <span class="help-block" v-if="errors['dressings']">
            {{ errors['dressings'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="ivsite">IV site(s)/Dressing, Saline lock or Continuous:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="ivsite" :value="assessment.ivsite">
          <span class="help-block" v-if="errors['ivsite']">
            {{ errors['ivsite'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="centrallines">Central lines/dressing:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="centrallines" :value="assessment.centrallines">
          <span class="help-block" v-if="errors['centrallines']">
            {{ errors['centrallines'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="heartrhythm">Heart Rhythm:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="heartrhythm" :value="assessment.heartrhythm">
          <span class="help-block" v-if="errors['heartrhythm']">
            {{ errors['heartrhythm'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="radial">Radial pulses (Rt. and Lt.):</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="radial" :value="assessment.radial">
          <span class="help-block" v-if="errors['radial']">
            {{ errors['radial'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="capillary">Capillary refill:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="capillary" :value="assessment.capillary">
          <span class="help-block" v-if="errors['capillary']">
            {{ errors['capillary'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="upper">Temperature/color of upper extremities:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="upper" :value="assessment.upper">
          <span class="help-block" v-if="errors['upper']">
            {{ errors['upper'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="breathrhythm">Breath sounds/rhythm:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="breathrhythm" :value="assessment.breathrhythm">
          <span class="help-block" v-if="errors['breathrhythm']">
            {{ errors['breathrhythm'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="cough">Breath sounds/cough:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="cough" :value="assessment.cough">
          <span class="help-block" v-if="errors['cough']">
            {{ errors['cough'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="secretions">Secretions/Sputum/Color:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="secretions" :value="assessment.secretions">
          <span class="help-block" v-if="errors['secretions']">
            {{ errors['secretions'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="roomair">Room air (or describe supplemental oxygen):</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="roomair" :value="assessment.roomair">
          <span class="help-block" v-if="errors['roomair']">
            {{ errors['roomair'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="nausea">Nausea/Vomiting/Tolerate Diet:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="nausea" :value="assessment.nausea">
          <span class="help-block" v-if="errors['nausea']">
            {{ errors['nausea'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="abdomen">Appearance of abdomen:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="abdomen" :value="assessment.abdomen">
          <span class="help-block" v-if="errors['abdomen']">
            {{ errors['abdomen'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="bowel">Bowel sounds:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="bowel" :value="assessment.bowel">
          <span class="help-block" v-if="errors['bowel']">
            {{ errors['bowel'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="stool">Stool characteristics/date of last BM:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="stool" :value="assessment.stool">
          <span class="help-block" v-if="errors['stool']">
            {{ errors['stool'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="tubefeeding">Tube feedings/Ostomy:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="tubefeeding" :value="assessment.tubefeeding">
          <span class="help-block" v-if="errors['tubefeeding']">
            {{ errors['tubefeeding'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="genitourinary">Continent/Incontinent/Foley, describe urine characteristics:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="genitourinary" :value="assessment.genitourinary">
          <span class="help-block" v-if="errors['genitourinary']">
            {{ errors['genitourinary'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="motion">Range of motion/mobility:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="motion" :value="assessment.motion">
          <span class="help-block" v-if="errors['motion']">
            {{ errors['motion'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="muscle">Muscle mass/strength:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="muscle" :value="assessment.muscle">
          <span class="help-block" v-if="errors['muscle']">
            {{ errors['muscle'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="pedal">Pedal pulses (Rt. and Lt.), D.P. and/or P.T., Femoral if applicable:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="pedal" :value="assessment.pedal">
          <span class="help-block" v-if="errors['pedal']">
            {{ errors['pedal'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="lower">Temp/color of lower extremities:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="lower" :value="assessment.lower">
          <span class="help-block" v-if="errors['lower']">
            {{ errors['lower'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="peripheral">Peripheral edema/Calf tenderness/pain/erythema:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="peripheral" :value="assessment.peripheral">
          <span class="help-block" v-if="errors['peripheral']">
            {{ errors['peripheral'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="ted">TED hose/SCD's:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="ted" :value="assessment.ted">
          <span class="help-block" v-if="errors['ted']">
            {{ errors['ted'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="restraints">Restraints/Casts:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="restraints" :value="assessment.restraints">
          <span class="help-block" v-if="errors['restraints']">
            {{ errors['restraints'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="drainage">Drainage/Drains:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="drainage" :value="assessment.drainage">
          <span class="help-block" v-if="errors['drainage']">
            {{ errors['drainage'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="activity">Activity-Bedrest/BRP/up with/without assistance:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="activity" :value="assessment.activity">
          <span class="help-block" v-if="errors['activity']">
            {{ errors['activity'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-offset-4 col-md-4">
          <button class="btn btn-primary" type="submit">Submit</button>
          <button class="btn btn-default" type="button" v-if="assessment.id !== 0" @click="cancel">Cancel</button>
        </div>
      </div>
    </form>
  </div>
  <div v-else>
    <button class="btn btn-primary col-md-1 pull-right" @click="setEdit">Edit</button>
    <div class="clearfix"></div>
    <div class="col-md-offset-2 col-md-5">
      <div class="row">
        <h4><b><u>Name: </u></b></h4>
        <p>{{ assessment.student_name }}</p>
      </div>
      <div class="row">
        <h4><b><u>Date: </u></b></h4>
        <p>{{ assessment.date }}</p>
      </div>
      <div class="row">
        <h4><b><u>Start time: </u></b></h4>
        <p>{{ assessment.start_time }}</p>
      </div>
      <div class="row">
        <h4><b><u>End time: </u></b></h4>
        <p>{{ assessment.end_time }}</p>
      </div>
      <div class="row">
        <h4><b><u>Patient MRN: </u></b></h4>
        <p>{{ assessment.medical_record_number }}</p>
      </div>
      <div class="row">
        <h4><b><u>Reason for admission: </u></b></h4>
        <p>{{ assessment.reason }}</p>
      </div>
      <div class="row">
        <h4><b><u>Temperature: </u></b></h4>
        <p>{{ assessment.temperature }}</p>
      </div>
      <div class="row">
        <h4><b><u>Blood pressure: </u></b></h4>
        <p>{{ assessment.bp_over }} / {{ assessment.bp_under }}</p>
      </div>
      <div class="row">
        <h4><b><u>Automatic: </u></b></h4>
        <p>{{ assessment.automatic ? 'Yes' : 'No' }}</p>
      </div>
      <div class="row">
        <h4><b><u>Apical pulse: </u></b></h4>
        <p>{{ assessment.apical_pulse }}</p>
      </div>
      <div class="row">
        <h4><b><u>Respiration: </u></b></h4>
        <p>{{ assessment.respiration }}</p>
      </div>
      <div class="row">
        <h4><b><u>Pulse oximetry: </u></b></h4>
        <p>{{ assessment.oximetry }}</p>
      </div>
      <div class="row">
        <h4><b><u>Allergies: </u></b></h4>
        <p>{{ assessment.allergies }}</p>
      </div>
      <div class="row">
        <h4><b><u>LOC: </u></b></h4>
        <p>{{ assessment.loc }}</p>
      </div>
      <div class="row">
        <h4><b><u>Orientation: </u></b></h4>
        <p>{{ assessment.orientation }}</p>
      </div>
      <div class="row">
        <h4><b><u>Speech: </u></b></h4>
        <p>{{ assessment.speech }}</p>
      </div>
      <div class="row">
        <h4><b><u>Behavior/Mood/Affect: </u></b></h4>
        <p>{{ assessment.behavior }}</p>
      </div>
      <div class="row">
        <h4><b><u>Memory: </u></b></h4>
        <p>{{ assessment.memory }}</p>
      </div>
      <div class="row">
        <h4><b><u>Pupillary response: </u></b></h4>
        <p>{{ assessment.pupillary }}</p>
      </div>
      <div class="row">
        <h4><b><u>Pain assessment/characteristics: </u></b></h4>
        <p>{{ assessment.pain }}</p>
      </div>
      <div class="row">
        <h4><b><u>Skin color: </u></b></h4>
        <p>{{ assessment.skincolor }}</p>
      </div>
      <div class="row">
        <h4><b><u>Skin temp/moisture: </u></b></h4>
        <p>{{ assessment.skintemp }}</p>
      </div>
      <div class="row">
        <h4><b><u>Hydration/Turgor: </u></b></h4>
        <p>{{ assessment.hydration }}</p>
      </div>
      <div class="row">
        <h4><b><u>Skin integrity: </u></b></h4>
        <p>{{ assessment.integrity }}</p>
      </div>
      <div class="row">
        <h4><b><u>Dressings/Wounds: </u></b></h4>
        <p>{{ assessment.dressings }}</p>
      </div>
      <div class="row">
        <h4><b><u>IV site(s)/Dressing, Saline lock or Continuous: </u></b></h4>
        <p>{{ assessment.ivsite }}</p>
      </div>
      <div class="row">
        <h4><b><u>Central lines/dressing: </u></b></h4>
        <p>{{ assessment.centrallines }}</p>
      </div>
      <div class="row">
        <h4><b><u>Heart Rhythm: </u></b></h4>
        <p>{{ assessment.heartrhythm }}</p>
      </div>
      <div class="row">
        <h4><b><u>Radial pulses (Rt. and Lt.): </u></b></h4>
        <p>{{ assessment.radial }}</p>
      </div>
      <div class="row">
        <h4><b><u>Capillary refill: </u></b></h4>
        <p>{{ assessment.capillary }}</p>
      </div>
      <div class="row">
        <h4><b><u>Temperature/color of upper extremities: </u></b></h4>
        <p>{{ assessment.upper }}</p>
      </div>
      <div class="row">
        <h4><b><u>Breath sounds/rhythm: </u></b></h4>
        <p>{{ assessment.breathrhythm }}</p>
      </div>
      <div class="row">
        <h4><b><u>Breath sounds/cough: </u></b></h4>
        <p>{{ assessment.cough }}</p>
      </div>
      <div class="row">
        <h4><b><u>Secretions/Sputum/Color: </u></b></h4>
        <p>{{ assessment.secretions }}</p>
      </div>
      <div class="row">
        <h4><b><u>Room air (or describe supplemental oxygen): </u></b></h4>
        <p>{{ assessment.roomair }}</p>
      </div>
      <div class="row">
        <h4><b><u>Nausea/Vomiting/Tolerate Diet: </u></b></h4>
        <p>{{ assessment.nausea }}</p>
      </div>
      <div class="row">
        <h4><b><u>Appearance of abdomen: </u></b></h4>
        <p>{{ assessment.abdomen }}</p>
      </div>
      <div class="row">
        <h4><b><u>Bowel sounds: </u></b></h4>
        <p>{{ assessment.bowel }}</p>
      </div>
      <div class="row">
        <h4><b><u>Stool characteristics/date of last BM: </u></b></h4>
        <p>{{ assessment.stool }}</p>
      </div>
      <div class="row">
        <h4><b><u>Tube feedings/Ostomy: </u></b></h4>
        <p>{{ assessment.tubefeeding }}</p>
      </div>
      <div class="row">
        <h4><b><u>Continent/Incontinent/Foley, describe urine characteristics: </u></b></h4>
        <p>{{ assessment.genitourinary }}</p>
      </div>
      <div class="row">
        <h4><b><u>Range of motion/mobility: </u></b></h4>
        <p>{{ assessment.motion }}</p>
      </div>
      <div class="row">
        <h4><b><u>Muscle mass/strength: </u></b></h4>
        <p>{{ assessment.muscle }}</p>
      </div>
      <div class="row">
        <h4><b><u>Pedal pulses (Rt. and Lt.), D.P. and/or P.T., Femoral if applicable: </u></b></h4>
        <p>{{ assessment.pedal }}</p>
      </div>
      <div class="row">
        <h4><b><u>Temp/color of lower extremities: </u></b></h4>
        <p>{{ assessment.lower }}</p>
      </div>
      <div class="row">
        <h4><b><u>Peripheral edema/Calf tenderness/pain/erythema: </u></b></h4>
        <p>{{ assessment.peripheral }}</p>
      </div>
      <div class="row">
        <h4><b><u>TED hose/SCD's: </u></b></h4>
        <p>{{ assessment.ted }}</p>
      </div>
      <div class="row">
        <h4><b><u>Restraints/Casts: </u></b></h4>
        <p>{{ assessment.restraints }}</p>
      </div>
      <div class="row">
        <h4><b><u>Drainage/Drains: </u></b></h4>
        <p>{{ assessment.drainage }}</p>
      </div>
      <div class="row">
        <h4><b><u>Activity-Bedrest/BRP/up with/without assistance: </u></b></h4>
        <p>{{ assessment.activity }}</p>
      </div>
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
            errors: {
                type: Object,
                default: {},
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
            cancel() {
                this.edit = false;
            },
        },
    }
</script>
