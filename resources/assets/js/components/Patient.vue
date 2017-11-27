<template>
  <div id="patient" v-if="Object.keys(patient).length === 0">
    <h3>Scan a patient to begin.</h3>
  </div>
  <div id="patient" v-else>
    <h3>Patient</h3>
    <hr>
    <dl class='dl-horizontal'>
      <dt>Name:</dt>
      <dd>{{ patient.first_name }} {{ patient.last_name }}</dd>
      <dt>DOB:</dt>
      <dd>{{ patient.dob }}</dd>
      <dt>MRN:</dt>
      <dd>{{ patient.mrn }}</dd>
      <dt>Sex:</dt>
      <dd>{{ patient.sex }}</dd>
      <dt>Physician:</dt>
      <dd>{{ patient.physician }}</dd>
      <dt>Room:</dt>
      <dd>{{ patient.room }}</dd>
    </dl>
    <hr>
    <div v-if="form">
      <input type="hidden" name="first_name" :value="patient.first_name" id="patient-first-name">
      <input type="hidden" name="last_name" :value="patient.last_name" id="patient-last-name">
      <input type="hidden" name="dob" :value="patient.dob" id="patient-dob">
      <input type="hidden" name="mrn" :value="patient.mrn" id="patient-mrn">
      <input type="hidden" name="sex" :value="patient.sex" id="patient-sex">
      <input type="hidden" name="physician" :value="patient.physician" id="patient-physician">
      <input type="hidden" name="room" :value="patient.room" id="patient-room">
    </div>
  </div>
</template>

<script>
    export default {
        props: {
            form: {
                type: Boolean,
                default: false,
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
            }
        },
        created() {
            this.$parent.$on('set-patient', this.setPatient);
        }
    }
</script>
