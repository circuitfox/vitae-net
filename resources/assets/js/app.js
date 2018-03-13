
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./jquery.scannerdetection');
let parser = require('./parser');
require('./medformatter');
require('./patientformatter');

// Scanner start character. One byte. The prefix character that the scanner
// is configured to use
const START_CHAR = 0x02;
// Scanner end character. One byte. The suffix character that the scanner
// is configured to use
const END_CHAR = 0x03;

window.Vue = require('vue');

const summaryPage = new Vue({
    el: '#summary-page',
    components: {
        'medication-list': require('./components/MedicationList.vue'),
        'patient': require('./components/Patient.vue')
    }
});

const addPatientPage = new Vue({
    el: '#patient-form',
    components: {
        'patient-form': require('./components/PatientForm.vue')
    }
});

const medicationForm = new Vue({
    el: '#medication-form',
    components: {
        'medication-form-list': require('./components/MedicationFormList.vue')
    }
});

const marForm = new Vue({
    el: '#mar-form',
    components: {
        'mar-form-list': require('./components/MarFormList.vue')
    }
});

function showAlert(message) {
    $('#scan-error-alert').html(`
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span>${message}</span>
    </div>`);
}

function deleteModal($, modelName) {
    $(`#${modelName}-delete-modal`).on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var model = button.data('id');
        var modal = $(this)
        modal.find(`#delete-${modelName}`).attr('action', `/${modelName}s/` + model);
    });
}

function onScanComplete($, barcode, qty) {
    let obj = parser.parse(barcode, START_CHAR, END_CHAR);
    let code_ver = 'v1';
    if (obj.code === 'barcode') {
        code_ver = 'v2';
    }
    if (obj.type === 'patient') {
        if ($('#summary-page').length) {
            console.log(obj.data);
            axios.post(`/api/${code_ver}/patients/verify`, obj.data).then(response => {
                let data = response.data;
                if (data.status === 'success') {
                    summaryPage.$emit('set-patient', data.data);
                } else if (data.status === 'error') {
                    showAlert('Could not find this patient in the database.');
                    console.log(data.data);
                }
            }).catch(error => {
                showAlert('Could not find this patient in the database');
                console.error(error);
            });
        } else {
            console.log(obj.data);
            addPatientPage.$emit('set-patient', obj.data);
        }
    } else if (obj.type === 'medication') {
        if ($('#summary-page').length) {
            axios.post(`/api/${code_ver}/medications/verify`, obj.data).then(response => {
                let data = response.data;
                if (data.status === 'success') {
                    summaryPage.$emit('add-medication', data.data);
                    $('#form-extra').show();
                } else if (data.status === 'error') {
                    showAlert('Could not find this medication in the database.');
                    console.log(data.data);
                }
            }).catch(error => {
                showAlert('Could not find this medication in the database.');
                console.error(error);
            });
        } else {
            console.log(obj.data);
            medicationForm.$emit('add-medication', obj.data);
        }
    } else {
        showAlert('Scanning failed. Unknown code format');
        console.log(barcode);
        console.log(obj);
    }
}

$(() => {
    // FIXME: find a better way to test this
    $(document).scannerDetection({
        timeBeforeScan: 200,
        startChar: [START_CHAR],
        endChar: [END_CHAR],
        avgTimeByChar: 40,
        minLength: 3, // barcode type + space + 1-digit id
        stopPropagation: true,
        preventDefault: false,
        onComplete: (barcode, qty) => onScanComplete($, barcode, qty),
    });

    $('#add-medication').on('click', () => {
        medicationForm.$emit('add-medication', {name: '', dosage_amount: 0, dosage_unit: ''});
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('#add-mar').on('click', () => {
        marForm.$emit('add-mar', {instructions: '', stat: 0});
    });

    deleteModal($, 'user');
    deleteModal($, 'patient');
    deleteModal($, 'medication');
    deleteModal($, 'order');
    deleteModal($, 'lab');
});
