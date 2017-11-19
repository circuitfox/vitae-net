
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

const summaryPage = new Vue({
    el: '#summary-page',
    components: {
        'medication-list': require('./components/MedicationList.vue'),
        'patient': require('./components/Patient.vue')
    }
});

$(function() {
    // FIXME: Scanning library setup & events
    // FIXME: find a better way to test this 
    console.log("patient emit");
    summaryPage.$emit('set-patient', {first_name: 'George', last_name: 'Smith', dob: '1/9/1993', mrn: 605065, sex: 'Male', physician: 'Dr. Jones', room: '12'});
    console.log("medication emit");
    summaryPage.$emit('add-medication', {name: 'Wellbutrin', dosage: 100, units: 'mg', instructions: '1 pill by mouth ever 4 hours', comments: '', stat: false});
});
