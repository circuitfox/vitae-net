<template>
  <div id="patient">
    <div class="form-group">
      <label class="col-md-2 control-label" for="first_name">First Name:</label>
      <input id="first-name" class="form-control" type="text" name="first_name" :value="patient.last_name" required>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="last_name">Last Name:</label>
      <input id="last-name" class="form-control" type="text" name="last_name" :value="patient.first_name" required>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="date_of_birth">Date of Birth:</label>
      <input id="dob" class="form-control" type="date" name="date_of_birth" :value="patient.dob" required>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="medical_record_number">Medical Record Number:</label>
      <input id="mrn" class="form-control" type="text" name="medical_record_number" :value="patient.mrn" required>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-2 control-label" for="sex">Sex:</label>
    <select id="sex" class="form-control" name="sex" form="patient-form">
      <option value="0">Female</option>
      <option value="1">Male</option>
    </select>
  </div>
  <div class="form-group">
    <label class="col-md-2 control-label" for="physician">Physician:</label>
    <input id="physician" class="form-control" type="text" name="physician" required>
  </div>
  <div class="form-group">
    <label class="col-md-2 control-label" for="room">Room:</label>
    <input class="form-control" type="text" required>
  </div>
</template>

<script>
    export default {
        data() {
            return {
                patient: {}
            }
        },
        methods() {
            setPatient(patient) {
                this.patient = patient;
                // parse the dob to the proper format, date inputs want 'yyyy-mm-dd'
                this.patient.dob = new Date(patient.dob).toISOString().split('T')[0];
            }
        }
        created() {
            this.$parent.$on('set-patient', this.setPatient);
        }
    }
</script>
