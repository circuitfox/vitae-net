<template>
  <div v-if="Object.keys(patient).length === 0">
    <h3>Scan a patient to begin.</h3>
  </div>
  <div v-else>
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
  </div>
</template>

<script>
    export default {
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
