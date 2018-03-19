export { parse };

const MEDICATION_FIELDS = 8;
const MEDICATION_FIELD_SEPARATOR = ';';
const PATIENT_FIELDS = 11;
const PATIENT_FIELD_SEPARATOR = ';';

const BARCODE_FIELDS = 2;
const BARCODE_PATIENT_TYPE = 'p';
const BARCODE_MEDICATION_TYPE = 'm';

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
    if (startChar < 0x10) {
        startChar = `0${startChar.toString(16)}`;
    } else {
        startChar = startChar.toString(16);
    }
    if (endChar < 0x10) {
        endChar = `0${endChar.toString(16)}`;
    } else {
        endChar = endChar.toString(16);
    }
    let parsedObj = {type: '', data: {}};
    let regex = new RegExp(`^\\x${startChar}?(.*)\\x${endChar}?$`);
    console.log(regex);
    let parseStr = str.replace(regex, '$1')
                      .split(PATIENT_FIELD_SEPARATOR);
    console.log(parseStr);
    if (parseStr.length === 1) {
        parseStr = parseStr[0].split(' ');
        parsedObj.code = 'barcode';
        if (parseStr.length !== BARCODE_FIELDS) {
            console.error('barcode is missing type');
        } else if (parseStr[0] === BARCODE_PATIENT_TYPE) {
            parsedObj.type = 'patient';
            parsedObj.data.medical_record_number = parseStr[1];
        } else if (parseStr[0] === BARCODE_MEDICATION_TYPE) {
            parsedObj.type = 'medication';
            parsedObj.data.medication_id = parseStr[1];
        } else {
            console.error(`unknown barcode type. barcode = ${parseStr}`);
        }
    } else if (parseStr.length === PATIENT_FIELDS) {
        parsedObj.type = 'patient';
        parsedObj.code = 'qr';
        parsedObj.data.medical_record_number = parseStr[0];
        parsedObj.data.last_name = parseStr[1];
        parsedObj.data.first_name = parseStr[2];
        parsedObj.data.date_of_birth = parseStr[3];
        parsedObj.data.sex = parseStr[4]
        parsedObj.data.height = parseStr[5]
        parsedObj.data.weight = parseStr[6]
        parsedObj.data.diagnosis = parseStr[7]
        parsedObj.data.code_status = parseStr[8]
        parsedObj.data.physician = parseStr[9]
        parsedObj.data.room = parseStr[10];
    } else if (parseStr.length < PATIENT_FIELDS) {
        parseStr = str
            .replace(regex, '$1')
            .split(MEDICATION_FIELD_SEPARATOR);
        if (parseStr.length < MEDICATION_FIELDS) {
            console.error(`QR code "${str}" is missing fields.\n`
                + `length=${parseStr.length}`);
        } else if (parseStr[0] === '') {
            console.error(`QR code "${str}" is missing a required name attribute`);
        } else if (parseStr.length > MEDICATION_FIELDS) {
            console.error(`Patient QR code "${str}" is missing fields.\n`
                + `length=${parseStr.length} expected=${PATIENT_FIELDS}`);
        } else {
            parsedObj.code = 'qr';
            parsedObj.type = 'medication';
            parsedObj.data.name = parseStr[0];
            parsedObj.data.dosage_amount = parseStr[1];
            parsedObj.data.dosage_unit = parseStr[2];
            parsedObj.data.secondary_name = parseStr[3];
            parsedObj.data.second_amount = parseStr[4];
            parsedObj.data.second_unit = parseStr[5];
            parsedObj.data.second_type = parseStr[6];
            parsedObj.data.comments = parseStr[7];
        }
    } else {
        console.error('QR Code "' + str + '" does not parse.');
    }
    console.log(parsedObj);
    return parsedObj;
}
