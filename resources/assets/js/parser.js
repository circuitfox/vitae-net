export { parse };

const MEDICATION_FIELDS = 8;
const MEDICATION_FIELD_SEPARATOR = ';';
const PATIENT_FIELDS = 12;
const PATIENT_FIELD_SEPARATOR = ';';

const BARCODE_FIELDS = 2;
const BARCODE_PATIENT_TYPE = 'p';
const BARCODE_MEDICATION_TYPE = 'm';

// converts a number less than 256 into a string usable in regular expressions
// hex character matcher.
Number.prototype.toRegexHex = function() {
    if (this < 0x10) {
        return `0${this.toString(16)}`;
    } else {
        return this.toString(16);
    }
}

// parse in the following order:
// - barcodes of the form
//   <type> <id>
// where type is BARCODE_PATIENT_TYPE for patients and BARCODE_MEDICATION_TYPE
// for medications. id represents the medical record number for a patient and
// the medication id for a medication.
// - patients of the form
//   medical_record_number;last_name;first_name;date_of_birth;sex;height;weight;diagnosis;code_status;physician;room
// Patients with mull fields are still required to have the semicolon separator. Patients which don't have
// PATIENT_FIELDS - 1 semicolons will be parsed as malformed, or possibly as
// a medication if they have MEDICATION_FIELDS - 1 semicolons. Typically,
// patients will have most or all of their fields filled, but only the MRN is
// required for successful parsing
// - medications of the form name;dosage_amount;dosage_unit;secondary_name;second_amount;second_unit;second_type;comments
// Medications with null fields are still required to have the semicolon separator. Medications which don't have
// MEDICATION_FIELDS - 1 semicolons will be parsed as malformed. This is so we can properly parse nullable fields.
// The only required attribute for medications is the name.
// startChar and endChar are the prefix and suffix that the barcode scanner
// adds to codes. They should be hexadecimal values.
function parse(str, startChar, endChar) {
    startChar = startChar.toRegexHex();
    endChar = endChar.toRegexHex();
    let parsedObj = {type: '', data: {}, code: ''};
    // we want to match the printable ascii range: (space (0x20) to ~ (0x7e))
    let regex = new RegExp(`^\\x${startChar}?([\\x20-\\x7e]*)\\x${endChar}?$`);
    let matchStr = str.match(regex);
    if (matchStr === null) {
        parsedObj.error = 'failed to match code. bad start or end characters?';
        return parsedObj;
    }
    let parseStr = matchStr[1].split(PATIENT_FIELD_SEPARATOR);
    // return early if the string is empty
    if (!matchStr[1]) {
        return parsedObj;
    }
    if (parseStr.length === 1) {
        return parseBarcode(parseStr);
    } else {
        return parseQrCode(parseStr);
    }
}

function parseBarcode(matchStr) {
    let parsedObj = {type: '', data: {}, code: ''};
    matchStr = matchStr[0].split(' ');
    let objId = Number.parseInt(matchStr[1]);
    parsedObj.code = 'barcode';
    if (Number.isNaN(objId)) {
        parsedObj.error = `barcode id must be a number. barcode = ${matchStr}`;
        return parsedObj;
    }
    if (matchStr[0] === BARCODE_PATIENT_TYPE) {
        parsedObj.type = 'patient';
        parsedObj.data.medical_record_number = objId;
    } else if (matchStr[0] === BARCODE_MEDICATION_TYPE) {
        parsedObj.type = 'medication';
        parsedObj.data.medication_id = objId;
    } else {
        parsedObj.error = `unknown barcode type. barcode = ${matchStr}`;
    }
    return parsedObj;
}

function parseQrCode(matchStr) {
    let parsedObj = {type: '', data: {}, code: ''};
    parsedObj.code = 'qr';
    if (matchStr.length === PATIENT_FIELDS) {
        parsedObj.type = 'patient';
        parsedObj.data.medical_record_number = matchStr[0];
        parsedObj.data.last_name = matchStr[1];
        parsedObj.data.first_name = matchStr[2];
        parsedObj.data.date_of_birth = matchStr[3];
        parsedObj.data.sex = matchStr[4]
        parsedObj.data.height = matchStr[5]
        parsedObj.data.weight = matchStr[6]
        parsedObj.data.diagnosis = matchStr[7]
        parsedObj.data.allergies = matchStr[8]
        parsedObj.data.code_status = matchStr[9]
        parsedObj.data.physician = matchStr[10]
        parsedObj.data.room = matchStr[11];
    } else if (matchStr.length > MEDICATION_FIELDS) {
        parsedObj.error = `Patient QR code is missing fields. ` +
            `length=${matchStr.length} expected=${PATIENT_FIELDS}`;
    } else if (matchStr.length < MEDICATION_FIELDS) {
        parsedObj.error = `QR code is missing fields. `
            + `length=${matchStr.length}`;
    } else if (matchStr[0] === '') {
        parsedObj.error = `QR code is missing a required name attribute. code = ${matchStr}`;
    } else if (matchStr.length === MEDICATION_FIELDS) {
        parsedObj.type = 'medication';
        parsedObj.data.name = matchStr[0];
        parsedObj.data.dosage_amount = matchStr[1];
        parsedObj.data.dosage_unit = matchStr[2];
        parsedObj.data.secondary_name = matchStr[3];
        parsedObj.data.second_amount = matchStr[4];
        parsedObj.data.second_unit = matchStr[5];
        parsedObj.data.second_type = matchStr[6];
        parsedObj.data.comments = matchStr[7];
    } else {
        parsedObj.error = `QR Code is invalid. code = ${matchStr}`;
    }
    return parsedObj;
}
