<template>
<div>
  <div v-if="edit || assessment.id == 0">
    <form class="form-horizontal" :action="route" :id="assessment" method="POST">
      <input type="hidden" name="_token" :value="csrfToken">
      <input type="hidden" name="id" :value="assessment.id">
      <div class="form-group required">
        <label class="col-md-4 control-label" for="student_name">Nurse:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="student_name" :value="assessment.student_name" required>
          <span class="help-block" v-if="errors['student_name']">
            {{ errors['student_name'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-md-4 control-label" for="date">Date:</label>
        <div class="col-md-6">
          <input class="form-control" type="date" name="date" :value="assessment.date" required>
          <span class="help-block" v-if="errors['date']">
            {{ errors['date'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-md-4 control-label" for="start_time">Start time:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="start_time" :value="assessment.start_time" required>
          <span class="help-block" v-if="errors['start_time']">
            {{ errors['start_time'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-md-4 control-label" for="end_time">End time:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="end_time" :value="assessment.end_time" required>
          <span class="help-block" v-if="errors['end_time']">
            {{ errors['end_time'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-md-4 control-label" for="medical_record_number">Patient MRN:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="medical_record_number" :value="mrn" required>
          <span class="help-block" v-if="errors['medical_record_number']">
            {{ errors['medical_record_number'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-md-4 control-label" for="reason">Reason for admission:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="reason" :value="assessment.reason" required>
          <span class="help-block" v-if="errors['reason']">
            {{ errors['reason'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-md-4 control-label" for="temperature">Temperature:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="temperature" :value="assessment.temperature" required>
          <span class="help-block" v-if="errors['temperature']">
            {{ errors['temperature'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-md-4 control-label" for="bp_over">Blood pressure:</label>
        <div class="col-md-1">
          <input class="form-control" type="text" name="bp_over" :value="assessment.bp_over" required>
          <span class="help-block" v-if="errors['bp_over']">
            {{ errors['bp_over'][0] }}
          </span>
        </div>
        <label class="col-md-1 control-label normal" for="bp_under" style="text-align:center;">/</label>
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
      <div class="form-group required">
        <label class="col-md-4 control-label" for="apical_pulse">Apical pulse:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="apical_pulse" :value="assessment.apical_pulse" required>
          <span class="help-block" v-if="errors['apical_pulse']">
            {{ errors['apical_pulse'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-md-4 control-label" for="respiration">Respiration:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="respiration" :value="assessment.respiration" required>
          <span class="help-block" v-if="errors['registration']">
            {{ errors['registration'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group required">
        <label class="col-md-4 control-label" for="oximetry">Pulse oximetry:</label>
        <div class="col-md-3">
          <input class="form-control" type="text" name="oximetry" :value="assessment.oximetry" required>
          <span class="help-block" v-if="errors['oximetry']">
            {{ errors['oximetry'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group required">
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
          <select class="form-control" name="loc" v-model="assessment.loc">
            <option value=""></option>
            <option>Alert</option>
            <option>Lethargic</option>
            <option>Responds to stimuli</option>
            <option>Unresponsive</option>
            <option>Delirium</option>
          </select>
          <span class="help-block" v-if="errors['loc']">
            {{ errors['loc'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="orientation">Orientation:</label>
        <div class="col-md-6">
          <select class="form-control" name="orientation" v-model="assessment.orientation">
            <option value=""></option>
            <option>Person</option>
            <option>Place</option>
            <option>Time</option>
            <option>Events</option>
          </select>
          <span class="help-block" v-if="errors['orientation']">
            {{ errors['orientation'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="speech">Speech:</label>
        <div class="col-md-6">
          <select class="form-control" name="speech" v-model="assessment.speech">
            <option value=""></option>
            <option>Clear</option>
            <option>Garbled</option>
            <option>Slurred</option>
          </select>
          <span class="help-block" v-if="errors['speech']">
            {{ errors['speech'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="behavior">Behavior/Mood/Affect:</label>
        <div class="col-md-6">
          <select class="form-control" name="behavior" v-model="assessment.behavior">
            <option value=""></option>
            <option>Appropriate for situation</option>
            <option>Inappropriate</option>
          </select>
          <span class="help-block" v-if="errors['behavior']">
            {{ errors['behavior'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="memory">Memory:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" list="memory-list" name="memory" v-model="assessment.memory">
          <datalist id="memory-list">
            <option>Intact</option>
          </datalist>
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
        <label class="col-md-4 control-label" for="pupil_size">Pupil size:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="pupil_size" :value="assessment.pupil_size">
          <span class="help-block" v-if="errors['pupil_size']">
            {{ errors['pupil_size'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="pupil_shape">Pupil shape:</label>
        <div class="col-md-6">
          <select class="form-control" name="pupil_shape" v-model="assessment.pupil_shape">
            <option value=""></option>
            <option>Equal</option>
            <option>Round</option>
          </select>
          <span class="help-block" v-if="errors['pupil_shape']">
            {{ errors['pupil_shape'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="accommodation">Accommodation:</label>
        <div class="col-md-6">
          <select class="form-control" name="accommodation" v-model="assessment.accommodation">
            <option value=""></option>
            <option>Yes</option>
            <option>No</option>
          </select>
          <span class="help-block" v-if="errors['accommodation']">
            {{ errors['accommodation'][0] }}
          </span>
        </div>
      </div>
      <div class="row">
        <h4 class="col-md-4 text-right"><b>Pain:</b></h4>
      </div>
      <hr>
      <div class="form-group">
        <label class="col-md-4 control-label" for="pain_scale">Pain Scale:</label>
        <div class="col-md-7">
          <label class="radio-inline" for="pain_scale">
            <input class="form-check-input" type="radio" name="pain_scale" v-model="assessment.pain_scale" value=1>1
          </label>
          <label class="radio-inline" for="pain_scale">
            <input class="form-check-input" type="radio" name="pain_scale" v-model="assessment.pain_scale" value=2>2
          </label>
          <label class="radio-inline" for="pain_scale">
            <input class="form-check-input" type="radio" name="pain_scale" v-model="assessment.pain_scale" value=3>3
          </label>
          <label class="radio-inline" for="pain_scale">
            <input class="form-check-input" type="radio" name="pain_scale" v-model="assessment.pain_scale" value=4>4
          </label>
          <label class="radio-inline" for="pain_scale">
            <input class="form-check-input" type="radio" name="pain_scale" v-model="assessment.pain_scale" value=5>5
          </label>
          <label class="radio-inline" for="pain_scale">
            <input class="form-check-input" type="radio" name="pain_scale" v-model="assessment.pain_scale" value=6>6
          </label>
          <label class="radio-inline" for="pain_scale">
            <input class="form-check-input" type="radio" name="pain_scale" v-model="assessment.pain_scale" value=7>7
          </label>
          <label class="radio-inline" for="pain_scale">
            <input class="form-check-input" type="radio" name="pain_scale" v-model="assessment.pain_scale" value=8>8
          </label>
          <label class="radio-inline" for="pain_scale">
            <input class="form-check-input" type="radio" name="pain_scale" v-model="assessment.pain_scale" value=9>9
          </label>
          <label class="radio-inline" for="pain_scale">
            <input class="form-check-input" type="radio" name="pain_scale" v-model="assessment.pain_scale" value=10>10
          </label>
          <span class="help-block" v-if="errors['pain_scale']">
            {{ errors['pain_scale'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="pain_location">Pain Location:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="pain_location" :value="assessment.pain_location">
          <span class="help-block" v-if="errors['pain_location']">
            {{ errors['pain_location'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="pain">Pain Description:</label>
        <div class="col-md-6">
          <select class="form-control" name="pain" v-model="assessment.pain">
            <option value=""></option>
            <option>Sharp</option>
            <option>Stabbing</option>
            <option>Dull</option>
            <option>Achy</option>
            <option>Tender</option>
            <option>Burning</option>
          </select>
          <span class="help-block" v-if="errors['pain']">
            {{ errors['pain'][0] }}
          </span>
        </div>
      </div>
      <div class="row">
        <h4 class="col-md-4 text-right"><b>Skin:</b></h4>
      </div>
      <hr>
      <div class="form-group">
        <label class="col-md-4 control-label" for="skincolor">Skin color:</label>
        <div class="col-md-6">
          <select class="form-control" name="skincolor" v-model="assessment.skincolor">
            <option value=""></option>
            <option>Appropriate for ethnicity</option>
            <option>Pale</option>
            <option>Jaundice</option>
            <option>Cyanotic</option>
          </select>
          <span class="help-block" v-if="errors['skincolor']">
            {{ errors['skincolor'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="skintemp">Skin temp/moisture:</label>
        <div class="col-md-6">
          <select class="form-control" name="skintemp" v-model="assessment.skintemp">
            <option value=""></option>
            <option>Warm</option>
            <option>Cool</option>
            <option>Hot</option>
            <option>Dry</option>
            <option>Moist </option>
            <option>Clammy</option>
          </select>
          <span class="help-block" v-if="errors['skintemp']">
            {{ errors['skintemp'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="hydration">Hydration/Turgor:</label>
        <div class="col-md-6">
          <select class="form-control" name="hydration" v-model="assessment.hydration">
            <option value=""></option>
            <option>Non-Tenting</option>
            <option>Tenting</option>
          </select>
          <span class="help-block" v-if="errors['hydration']">
            {{ errors['hydration'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="integrity">Skin integrity:</label>
        <div class="col-md-6">
          <input class="form-control" list="integrity-list" type="text" name="integrity" v-model="assessment.integrity">
          <datalist id="integrity-list">
            <option>Intact</option>
            <option>Not intact</option>
          </datalist>
          <span class="help-block" v-if="errors['integrity']">
            {{ errors['integrity'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="dressings">Dressings/Wounds:</label>
        <div class="col-md-6">
          <input class="form-control" list="dressings-list" type="text" name="dressings" v-model="assessment.dressings">
          <datalist id="dressings-list">
            <option>Intact</option>
            <option>Clean</option>
            <option>Dry</option>
            <option>Drainage</option>
          </datalist>
          <span class="help-block" v-if="errors['dressings']">
            {{ errors['dressings'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="ivsite">IV site(s)/Dressing, Saline lock or Continuous:</label>
        <div class="col-md-6">
          <select class="form-control" name="ivsite" v-model="assessment.ivsite">
            <option value=""></option>
            <option>Clear</option>
            <option>Infiltrated</option>
            <option>Redness</option>
            <option>Swelling </option>
            <option>Pain</option>
          </select>
          <span class="help-block" v-if="errors['ivsite']">
            {{ errors['ivsite'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="centrallines">Central lines/dressing:</label>
        <div class="col-md-6">
          <input class="form-control" list="centralines-list" type="text" name="centrallines" v-model="assessment.centrallines">
          <datalist id="centralines-list">
            <option>Intact</option>
            <option>Loose</option>
          </datalist>
          <span class="help-block" v-if="errors['centrallines']">
            {{ errors['centrallines'][0] }}
          </span>
        </div>
      </div>
      <div class="row">
        <h4 class="col-md-4 text-right"><b>Circulatory:</b></h4>
      </div>
      <hr>
      <div class="form-group">
        <label class="col-md-4 control-label" for="heartrhythm">Heart Rhythm:</label>
        <div class="col-md-6">
          <select class="form-control" name="heartrhythm" v-model="assessment.heartrhythm">
            <option value=""></option>
            <option>Regular</option>
            <option>Irregular</option>
          </select>
          <span class="help-block" v-if="errors['heartrhythm']">
            {{ errors['heartrhythm'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="radial">Radial pulses (Rt. and Lt.):</label>
        <div class="col-md-6">
          <input class="form-control" list="radial-list" type="text" name="radial" v-model="assessment.radial">
          <datalist id="radial-list">
            <option>Equal Bilaterally</option>
          </datalist>
          <span class="help-block" v-if="errors['radial']">
            {{ errors['radial'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="capillary">Capillary refill:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" list="capillary-list" name="capillary" v-model="assessment.capillary">
          <datalist id="capillary-list">
            <option>&lt;3 seconds</option>
            <option>&gt;3 seconds</option>
          </datalist>
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
      <div class="row">
        <h4 class="col-md-4 text-right"><b>Respiratory:</b></h4>
      </div>
      <hr>
      <div class="form-group">
        <label class="col-md-4 control-label" for="right_breath">Right breath sounds/rhythm:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" list="right_breath" name="right_breath" v-model="assessment.right_breath">
          <datalist id="right_breath">
            <option>Clear</option>
            <option>Diminished</option>
            <option>Crackles</option>
            <option>Rhonchi</option>
            <option>Wheeze</option>
            <option>Stridor</option>
            <option>Rales</option>
          </datalist>
          <span class="help-block" v-if="errors['breathrhythm']">
            {{ errors['right_breath'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="left_breath">Left breath sounds/rhythm:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" list="left_breath" name="left_breath" v-model="assessment.left_breath">
          <datalist id="left_breath">
            <option>Clear</option>
            <option>Diminished</option>
            <option>Crackles</option>
            <option>Rhonchi</option>
            <option>Wheeze</option>
            <option>Stridor</option>
            <option>Rales</option>
          </datalist>
          <span class="help-block" v-if="errors['breathrhythm']">
            {{ errors['left_breath'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="cough">Cough:</label>
        <div class="col-md-6">
          <input class="form-control" list="cough-list" type="text" name="cough" v-model="assessment.cough">
          <datalist>
            <option>None</option>
            <option>Productive</option>
            <option>Non-Productive</option>
          </datalist>
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
        <label class="col-md-4 control-label" for="supplemental">Supplemental Oxygen:</label>
        <div class="col-md-6">
          <select class="form-control" name="supplemental" v-model="assessment.supplemental">
            <option value=""></option>
            <option>None</option>
            <option>Nasal cannula</option>
            <option>Face mask</option>
            <option>Non-rebreather </option>
            <option>Venturi mask</option>
          </select>
          <span class="help-block" v-if="errors['supplemental']">
            {{ errors['supplemental'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="liters_per_minute">Liters/Minute of Oxygen</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="liters_per_minute" :value="assessment.liters_per_minute">
          <span class="help-block" v-if="errors['liters_per_minute']">
            {{ errors['liters_per_minute'][0] }}
          </span>
        </div>
      </div>
      <div class="row">
        <h4 class="col-md-4 text-right"><b>Gastrointestinal:</b></h4>
      </div>
      <hr>
      <div class="form-group">
        <label class="col-md-4 control-label" for="diet">Diet:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="diet" :value="assessment.diet">
          <span class="help-block" v-if="errors['diet']">
            {{ errors['diet'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="nausea">Tolerated/Nausea/Vomiting:</label>
        <div class="col-md-6">
          <input class="form-control" list="nausea-list" type="text" name="nausea" v-model="assessment.nausea">
          <datalist id="nausea-list">
            <option>Tolerated</option>
            <option>Nausea</option>
            <option>Vomiting</option>
          </datalist>
          <span class="help-block" v-if="errors['nausea']">
            {{ errors['nausea'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="abdomen">Appearance of abdomen:</label>
        <div class="col-md-6">
          <input class="form-control" list="abdomen-list" type="text" name="abdomen" v-model="assessment.abdomen">
          <datalist id="bowel-list">
            <option>Soft</option>
            <option>Round</option>
            <option>Flat</option>
            <option>Concave</option>
            <option>Non-distended</option>
            <option>Distended</option>
          </datalist>
          <span class="help-block" v-if="errors['abdomen']">
            {{ errors['abdomen'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="bowel">Bowel sounds:</label>
        <div class="col-md-6">
          <input class="form-control" list="bowel-list" type="text" name="bowel" v-model="assessment.bowel">
          <datalist id="bowel-list">
            <option>Present</option>
            <option>Hypoactive</option>
            <option>Hyperactive</option>
            <option>Absent</option>
          </datalist>
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
        <label class="col-md-4 control-label" for="genitourinary">GU:</label>
        <div class="col-md-6">
          <select class="form-control" name="genitourinary" v-model="assessment.genitourinary">
            <option value=""></option>
            <option>Continent</option>
            <option>Incontinent</option>
            <option>Foley</option>
          </select>
          <span class="help-block" v-if="errors['genitourinary']">
            {{ errors['genitourinary'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="genitourinary">Urine characteristics:</label>
        <div class="col-md-6">
          <input class="form-control" list="urine-list" type="text" name="urine" v-model="assessment.urine">
          <datalist id="urine-list">
            <option>Clear</option>
            <option>Yellow</option>
            <option>Straw</option>
            <option>Amber</option>
            <option>Cloudy</option>
            <option>Bloody</option>
            <option>Odor</option>
          </datalist>
          <span class="help-block" v-if="errors['urine']">
            {{ errors['urine'][0] }}
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
      <div class="row">
        <h4 class="col-md-4 text-right"><b>Lower Extremities:</b></h4>
      </div>
      <hr>
      <div class="form-group">
        <label class="col-md-4 control-label" for="right_pedal">Right Pedal pulse, D.P. and/or P.T., Femoral if applicable:</label>
        <div class="col-md-6">
          <select class="form-control" name="right_pedal" v-model="assessment.right_pedal">
            <option value=""></option>
            <option>0</option>
            <option>1+</option>
            <option>2+</option>
            <option>3+</option>
          </select>
          <span class="help-block" v-if="errors['right_pedal']">
            {{ errors['right_pedal'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="left_pedal">Left Pedal pulse, D.P. and/or P.T., Femoral if applicable:</label>
        <div class="col-md-6">
          <select class="form-control" name="left_pedal" v-model="assessment.left_pedal">
            <option value=""></option>
            <option>0</option>
            <option>1+</option>
            <option>2+</option>
            <option>3+</option>
          </select>
          <span class="help-block" v-if="errors['left_pedal']">
            {{ errors['left_pedal'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="lower">Temp/color of right lower extremity:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="right_lower" :value="assessment.right_lower">
          <span class="help-block" v-if="errors['right_lower']">
            {{ errors['right_lower'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="lower">Temp/color of left lower extremity:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="left_lower" :value="assessment.left_lower">
          <span class="help-block" v-if="errors['left_lower']">
            {{ errors['left_lower'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="peripheral">Peripheral edema:</label>
        <div class="col-md-6">
          <select class="form-control" name="peripheral" v-model="assessment.peripheral">
            <option value=""></option>
            <option>Absent</option>
            <option>1+</option>
            <option>2+</option>
            <option>3+</option>
            <option>4+</option>
          </select>
          <span class="help-block" v-if="errors['peripheral']">
            {{ errors['peripheral'][0] }}
          </span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="calf">Calf tenderness/pain/erythema:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="calf" :value="assessment.calf">
          <span class="help-block" v-if="errors['calf']">
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
        <label class="col-md-4 control-label" for="drainage">Drainage/Drains:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" name="drainage" :value="assessment.drainage">
          <span class="help-block" v-if="errors['drainage']">
            {{ errors['drainage'][0] }}
          </span>
        </div>
      </div>
      <div class="row">
        <h4 class="col-md-4 text-right"><b>Assistance:</b></h4>
      </div>
      <hr>
      <div class="form-group">
        <label class="col-md-4 control-label" for="activity">Ambulatory:</label>
        <div class="col-md-6">
          <input class="form-control" type="text" list="activity-list" name="activity" :value="assessment.activity">
          <datalist id="activity-list">
            <option>Unassisted</option>
            <option>1 assist with Gait belt</option>
            <option>2 assist with Gait belt</option>
            <option>Bedrest</option>
          </datalist>
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
        <h5><b><u>Nurse:</u></b></h5>
        <p>{{ assessment.student_name }}</p>
      </div>
      <div class="row">
        <h5><b><u>Date:</u></b></h5>
        <p>{{ assessment.date }}</p>
      </div>
      <div class="row">
        <h5><b><u>Start time:</u></b></h5>
        <p>{{ assessment.start_time }}</p>
      </div>
      <div class="row">
        <h5><b><u>End time:</u></b></h5>
        <p>{{ assessment.end_time }}</p>
      </div>
      <div class="row">
        <h5><b><u>Patient MRN:</u></b></h5>
        <p>{{ assessment.medical_record_number }}</p>
      </div>
      <div class="row">
        <h5><b><u>Reason for admission:</u></b></h5>
        <p>{{ assessment.reason }}</p>
      </div>
      <div class="row">
        <h5><b><u>Temperature:</u></b></h5>
        <p>{{ assessment.temperature }}</p>
      </div>
      <div class="row">
        <h5><b><u>Blood pressure:</u></b></h5>
        <p>{{ assessment.bp_over }} / {{ assessment.bp_under }}</p>
      </div>
      <div class="row">
        <h5><b><u>Automatic:</u></b></h5>
        <p>{{ assessment.automatic ? 'Yes' : 'No' }}</p>
      </div>
      <div class="row">
        <h5><b><u>Apical pulse:</u></b></h5>
        <p>{{ assessment.apical_pulse }}</p>
      </div>
      <div class="row">
        <h5><b><u>Respiration:</u></b></h5>
        <p>{{ assessment.respiration }}</p>
      </div>
      <div class="row">
        <h5><b><u>Pulse oximetry:</u></b></h5>
        <p>{{ assessment.oximetry }}</p>
      </div>
      <div class="row">
        <h5><b><u>Allergies:</u></b></h5>
        <p>{{ assessment.allergies }}</p>
      </div>
      <div class="row">
        <h5><b><u>LOC:</u></b></h5>
        <p>{{ assessment.loc }}</p>
      </div>
      <div class="row">
        <h5><b><u>Orientation:</u></b></h5>
        <p>{{ assessment.orientation }}</p>
      </div>
      <div class="row">
        <h5><b><u>Speech:</u></b></h5>
        <p>{{ assessment.speech }}</p>
      </div>
      <div class="row">
        <h5><b><u>Behavior/Mood/Affect:</u></b></h5>
        <p>{{ assessment.behavior }}</p>
      </div>
      <div class="row">
        <h5><b><u>Memory:</u></b></h5>
        <p>{{ assessment.memory }}</p>
      </div>
      <div class="row">
        <h5><b><u>Pupillary response:</u></b></h5>
        <p>{{ assessment.pupillary }}</p>
      </div>
      <div class="row">
        <h5><b><u>Pupil size:</u></b></h5>
        <p>{{ assessment.pupil_size }}</p>
      </div>
      <div class="row">
        <h5><b><u>Pupil shape:</u></b></h5>
        <p>{{ assessment.pupil_shape }}</p>
      </div>
      <div class="row">
        <h5><b><u>Accommodation:</u></b></h5>
        <p>{{ assessment.accommodation }}</p>
      </div>
      <div class="row">
        <h4><b>Pain:</b></h4>
      </div>
      <hr>
      <div class="row">
        <h5><b><u>Pain Scale:</u></b></h5>
        <p>{{ assessment.pain_scale }}</p>
      </div>
      <div class="row">
        <h5><b><u>Pain Location:</u></b></h5>
        <p>{{ assessment.pain_location }}</p>
      </div>
      <div class="row">
        <h5><b><u>Pain Description:</u></b></h5>
        <p>{{ assessment.pain }}</p>
      </div>
      <div class="row">
        <h4><b>Skin:</b></h4>
      </div>
      <hr>
      <div class="row">
        <h5><b><u>Skin color:</u></b></h5>
        <p>{{ assessment.skincolor }}</p>
      </div>
      <div class="row">
        <h5><b><u>Skin temp/moisture:</u></b></h5>
        <p>{{ assessment.skintemp }}</p>
      </div>
      <div class="row">
        <h5><b><u>Hydration/Turgor:</u></b></h5>
        <p>{{ assessment.hydration }}</p>
      </div>
      <div class="row">
        <h5><b><u>Skin integrity:</u></b></h5>
        <p>{{ assessment.integrity }}</p>
      </div>
      <div class="row">
        <h5><b><u>Dressings/Wounds:</u></b></h5>
        <p>{{ assessment.dressings }}</p>
      </div>
      <div class="row">
        <h5><b><u>IV site(s)/Dressing, Saline lock or Continuous:</u></b></h5>
        <p>{{ assessment.ivsite }}</p>
      </div>
      <div class="row">
        <h5><b><u>Central lines/dressing:</u></b></h5>
        <p>{{ assessment.centrallines }}</p>
      </div>
      <div class="row">
        <h4><b>Circulatory:</b></h4>
      </div>
      <hr>
      <div class="row">
        <h5><b><u>Heart Rhythm:</u></b></h5>
        <p>{{ assessment.heartrhythm }}</p>
      </div>
      <div class="row">
        <h5><b><u>Radial pulses (Rt. and Lt.):</u></b></h5>
        <p>{{ assessment.radial }}</p>
      </div>
      <div class="row">
        <h5><b><u>Capillary refill:</u></b></h5>
        <p>{{ assessment.capillary }}</p>
      </div>
      <div class="row">
        <h5><b><u>Temperature/color of upper right extremity:</u></b></h5>
        <p>{{ assessment.right_upper }}</p>
      </div>
      <div class="row">
        <h5><b><u>Temperature/color of upper left extremity:</u></b></h5>
        <p>{{ assessment.left_upper }}</p>
      </div>
      <div class="row">
        <h4><b>Respiratory:</b></h4>
      </div>
      <hr>
      <div class="row">
        <h5><b><u>Right breath sounds/rhythm:</u></b></h5>
        <p>{{ assessment.right_breath }}</p>
      </div>
      <div class="row">
        <h5><b><u>Left breath sounds/rhythm:</u></b></h5>
        <p>{{ assessment.left_breath }}</p>
      </div>
      <div class="row">
        <h5><b><u>Cough:</u></b></h5>
        <p>{{ assessment.cough }}</p>
      </div>
      <div class="row">
        <h5><b><u>Secretions/Sputum/Color:</u></b></h5>
        <p>{{ assessment.secretions }}</p>
      </div>
      <div class="row">
        <h5><b><u>Supplemental oxygen:</u></b></h5>
        <p>{{ assessment.supplemental }}</p>
      </div>
      <div class="row">
        <h5><b><u>Liters/Minute of Oxygen:</u></b></h5>
        <p>{{ assessment.liters_per_minute }}</p>
      </div>
      <div class="row">
        <h4><b>Gastrointestinal:</b></h4>
      </div>
      <hr>
      <div class="row">
        <h5><b><u>Diet:</u></b></h5>
        <p>{{ assessment.diet }}</p>
      </div>
      <div class="row">
        <h5><b><u>Tolerated/Nausea/Vomiting:</u></b></h5>
        <p>{{ assessment.nausea }}</p>
      </div>
      <div class="row">
        <h5><b><u>Appearance of abdomen:</u></b></h5>
        <p>{{ assessment.abdomen }}</p>
      </div>
      <div class="row">
        <h5><b><u>Bowel sounds:</u></b></h5>
        <p>{{ assessment.bowel }}</p>
      </div>
      <div class="row">
        <h5><b><u>Stool characteristics/date of last BM:</u></b></h5>
        <p>{{ assessment.stool }}</p>
      </div>
      <div class="row">
        <h5><b><u>Tube feedings/Ostomy:</u></b></h5>
        <p>{{ assessment.tubefeeding }}</p>
      </div>
      <div class="row">
        <h5><b><u>GU:</u></b></h5>
        <p>{{ assessment.genitourinary }}</p>
      </div>
      <div class="row">
        <h5><b><u>Urine characteristics:</u></b></h5>
        <p>{{ assessment.urine }}</p>
      </div>
      <div class="row">
        <h5><b><u>Range of motion/mobility:</u></b></h5>
        <p>{{ assessment.motion }}</p>
      </div>
      <div class="row">
        <h5><b><u>Muscle mass/strength:</u></b></h5>
        <p>{{ assessment.muscle }}</p>
      </div>
      <div class="row">
        <h4><b>Lower Extremities:</b></h4>
      </div>
      <hr>
      <div class="row">
        <h5><b><u>Right pedal pulse, D.P. and/or P.T., Femoral if applicable:</u></b></h5>
        <p>{{ assessment.right_pedal }}</p>
      </div>
      <div class="row">
        <h5><b><u>Left pedal pulse, D.P. and/or P.T., Femoral if applicable:</u></b></h5>
        <p>{{ assessment.left_pedal }}</p>
      </div>
      <div class="row">
        <h5><b><u>Temp/color of right lower extremity:</u></b></h5>
        <p>{{ assessment.right_lower }}</p>
      </div>
      <div class="row">
        <h5><b><u>Temp/color of left lower extremity:</u></b></h5>
        <p>{{ assessment.left_lower }}</p>
      </div>
      <div class="row">
        <h5><b><u>Peripheral edema:</u></b></h5>
        <p>{{ assessment.peripheral }}</p>
      </div>
      <div class="row">
        <h5><b><u>Calf tenderness/pain/erythema:</u></b></h5>
        <p>{{ assessment.calf }}</p>
      </div>
      <div class="row">
        <h5><b><u>TED hose/SCD's:</u></b></h5>
        <p>{{ assessment.ted }}</p>
      </div>
      <div class="row">
        <h5><b><u>Drainage/Drains:</u></b></h5>
        <p>{{ assessment.drainage }}</p>
      </div>
      <div class="row">
        <h4><b>Assistance:</b></h4>
      </div>
      <hr>
      <div class="row">
        <h5><b><u>Ambulatory:</u></b></h5>
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
