<template>
  <div id="patient" v-if="Object.keys(patient).length === 0">
    <h3>Scan a patient to begin.</h3>
  </div>
  <div id="patient" v-else>
    <h3>Patient</h3>
    <hr>
    <dl class='dl-horizontal dl-wrap'>
      <dt>Name:</dt>
      <dd>{{ patient.first_name }} {{ patient.last_name }}</dd>
      <dt>DOB:</dt>
      <dd>{{ patient.date_of_birth }}</dd>
      <dt>MRN:</dt>
      <dd>{{ patient.medical_record_number }}</dd>
      <dt>Sex:</dt>
      <dd>{{ patient.sex }}</dd>
      <dt>Height:</dt>
      <dd>{{ patient.height }}</dd>
      <dt>Weight:</dt>
      <dd>{{ patient.weight }}</dd>
      <dt>Diagnosis:</dt>
      <dd>{{ patient.diagnosis }}</dd>
      <dt>Allergies:</dt>
      <dd>{{ patient.allergies }}</dd>
      <dt>Code Status:</dt>
      <dd>{{ patient.code_status }}</dd>
      <dt>Physician:</dt>
      <dd>{{ patient.physician }}</dd>
      <dt>Room:</dt>
      <dd>{{ patient.room }}</dd>
    </dl>
    <hr>
    <div v-if="form">
      <input type="hidden" name="first_name" :value="patient.first_name" id="patient-first-name">
      <input type="hidden" name="last_name" :value="patient.last_name" id="patient-last-name">
      <input type="hidden" name="date_of_birth" :value="patient.date_of_birth" id="patient-date-of-birth">
      <input type="hidden" name="medical_record_number" :value="patient.medical_record_number" id="patient-medical-record-number">
      <input type="hidden" name="sex" :value="patient.sex" id="patient-sex">
      <input type="hidden" name="height" :value="patient.height" id="patient-height">
      <input type="hidden" name="weight" :value="patient.weight" id="patient-weight">
      <input type="hidden" name="diagnosis" :value="patient.diagnosis" id="patient-date-of-birth">
      <input type="hidden" name="allergies" :value="patient.allergies" id="patient-allergies">
      <input type="hidden" name="code_status" :value="patient.code_status" id="patient-code-status">
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
