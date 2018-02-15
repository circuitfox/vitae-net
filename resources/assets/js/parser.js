export { parse };

const MEDICATION_FIELDS = 8;
const MEDICATION_FIELD_SEPARATOR = ';';

// parse in the following order:
// - patients
// - medications of the form name;dosage_amount;dosage_unit;secondary_name;second_amount;second_unit;second_type;comments
// Medications with null fields are still required to have the semicolon separator. Medications which don't have
// MEDICATION_FIELDS - 1 semicolons will be parsed as malformed. This is so we can properly parse nullable fields.
// The only required attribute for medications is the name.
function parse(str) {
    let parsedObj = {type: '', data: {}};
    let patientRegex = /^\x02?(\w+)[,.]? (\w+)(?:DOB:\ ?)?(\d{1,2}[.\/]\d{1,2}[.\/](?:\d{4}|\d{2}XX))(?:(?:MRN:\ ?)?(\d{6}))?\x03?$/;
    let medicationRegex = /^\x02?(.*)\x03?$/;
    let parseStr = patientRegex.exec(str);
    if (parseStr) {
        parsedObj.type = 'patient';
        parsedObj.data.last_name = parseStr[1];
        parsedObj.data.first_name = parseStr[2];
        parsedObj.data.dob = parseStr[3];
        if (parseStr[4]) {
            parsedObj.data.mrn = parseStr[4];
        }
    } else if ((parseStr = str
                    .replace(medicationRegex, '$1')
                    .split(MEDICATION_FIELD_SEPARATOR))) {
        if (parseStr.length < MEDICATION_FIELDS) {
            console.error(`Medication QR code "${str}" is missing fields.`
                + `length=${parseStr.length} expected=${MEDICATION_FIELDS}`);
        } else if (parseStr[0] === '') {
            console.error(`Medication QR code "${str}" is missing a required name attribute`);
        } else {
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
