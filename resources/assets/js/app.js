
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
const START_CHAR = 0x60;
// Scanner end character. One byte. The suffix character that the scanner
// is configured to use
const END_CHAR = 0x7e;

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

const marEntry = new Vue({
    el: '#mar',
    components: {
        'mar-entry': require('./components/MarEntry.vue')
    }
});

const assessmentForm = new Vue({
    el: '#assessment-form',
    components: {
        'assessment-form': require('./components/AssessmentForm.vue')
    }
});

function showErrorAlert(message) {
    $('#scan-error-alert').html(`
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span>${message}</span>
    </div>`);
}

function showMedAlert(message) {
    $('#scan-med-alert').html(`
    <div class="alert alert-info alert-dismissable">
      <button class="close" type="button" data-dismiss="alert" aria-label="Close">
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

/*
 * Verify the information scanned for the given model,
 * emitting an event and potentially calling a function if
 * verified.
 */
function verify(model, obj, eventStr, ifVerified = undefined) {
    let verified = false;
    let code_ver = 'v1';
    if (obj.code === 'barcode') {
        code_ver = 'v2';
    }
    console.log(obj.data);
    axios.post(`/api/${code_ver}/${model}/verify`, obj.data).then(response => {
        let data = response.data;
        if (data.status === 'success') {
            summaryPage.$emit(eventStr, data.data);
            if (ifVerified !== undefined) {
                ifVerified();
            }
        } else if (data.status === 'error') {
            showErrorAlert(`Could not find this ${obj.type} in the database.`);
            console.log(data.data);
        }
    }).catch(error => {
        showErrorAlert(`Could not find this ${obj.type} in the database.`);
        console.error(error);
    });
    return verified;
}

function onScanComplete($, barcode, qty) {
    let obj = parser.parse(barcode, START_CHAR, END_CHAR);
    if (obj.type === 'patient') {
        if ($('#summary-page').length) {
            let verified = verify('patients', obj, 'set-patient', () => {
                showMedAlert("Scan medication for patient");
            });
            console.log(verified);
        } else {
            console.log(obj.data);
            addPatientPage.$emit('set-patient', obj.data);
        }
    } else if (obj.type === 'medication') {
        if ($('#summary-page').length) {
            let verified = verify('medications', obj, 'add-medication');
        } else {
            console.log(obj.data);
            medicationForm.$emit('add-medication', obj.data);
        }
    } else {
        showErrorAlert('Scanning failed. Unknown code format');
        console.error(obj.error);
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

    $(`#order-complete-modal`).on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this)
        modal.find(`#complete-id`).attr('value', id);
    });

    deleteModal($, 'user');
    deleteModal($, 'patient');
    deleteModal($, 'medication');
    deleteModal($, 'order');
    deleteModal($, 'lab');
});
