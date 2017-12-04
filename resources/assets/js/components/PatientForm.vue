<template>
  <div id="patient">
    <div class="form-group">
      <label class="col-md-2 control-label" for="first_name">First Name:</label>
      <div class="col-md-6">
        <input id="first-name" class="form-control" type="text" name="first_name" :value="patient.fist_name" required>
        <span class="help-block" v-if="errors['first_name']">
          <strong>{{ errors.first_name[0] }}</strong>
        </span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="last_name">Last Name:</label>
      <div class="col-md-6">
        <input id="last-name" class="form-control" type="text" name="last_name" :value="patient.last_name" required>
        <span class="help-block" v-if="errors['last_name']">
          <strong>{{ errors.last_name[0] }}</strong>
        </span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="date_of_birth">Date of Birth:</label>
      <div class="col-md-6">
        <input id="dob" class="form-control" type="date" name="date_of_birth" :value="patient.dob" required>
        <span class="help-block" v-if="errors['date_of_birth']">
          <strong>{{ errors.date_of_birth[0] }}</strong>
        </span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="medical_record_number">Medical Record Number:</label>
      <div class="col-md-6">
        <input id="mrn" class="form-control" type="text" name="medical_record_number" :value="patient.mrn" required>
        <span class="help-block" v-if="errors['medical_record_number']">
          <strong>{{ errors.medical_record_number[0] }}</strong>
        </span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="sex">Sex:</label>
      <div class="col-md-6">
        <select id="sex" class="form-control" name="sex" form="patient-form">
          <option value="0">Female</option>
          <option value="1">Male</option>
        </select>
        <span class="help-block" v-if="errors['sex']">
          <strong>{{ errors.sex[0] }}</strong>
        </span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="physician">Physician:</label>
      <div class="col-md-6">
        <input id="physician" class="form-control" type="text" name="physician" required>
        <span class="help-block" v-if="errors['physician']">
          <strong>{{ errors.physician[0] }}</strong>
        </span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="room">Room:</label>
      <div class="col-md-6">
        <input class="form-control" type="text" name="room" required>
        <span class="help-block" v-if="errors['room']">
          <strong>{{ errors.room[0] }}</strong>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        props: {
            errors: {
                type: Object,
                default: {},
            }
        },
        data() {
            return {
                patient: {}
            }
        },
        methods: {
            setPatient(patient) {
                this.patient = patient;
                // parse the dob to the proper format, date inputs want 'yyyy-mm-dd'
                this.patient.dob = new Date(patient.dob).toISOString().split('T')[0];
            }
        },
        created() {
            this.$parent.$on('set-patient', this.setPatient);
        }
    }
</script>
