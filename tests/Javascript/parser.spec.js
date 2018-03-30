import { parse } from '../../resources/assets/js/parser.js';

describe('parser.parse', () => {
    it('should return an empty object with an empty string', () => {
        let obj = parse('', 0x02, 0x03);
        expect(obj.type).toEqual('');
        expect(obj.data).toEqual({});
        expect(obj.code).toEqual('');
    });

    it('should return an empty object with a string containing only the start character', () => {
        let obj = parse('\x02', 0x02, 0x03);
        expect(obj.type).toEqual('');
        expect(obj.data).toEqual({});
        expect(obj.code).toEqual('');
    });

    it('should return an empty object with a string containing only the end character', () => {
        let obj = parse('\x03', 0x02, 0x03);
        expect(obj.type).toEqual('');
        expect(obj.data).toEqual({});
        expect(obj.code).toEqual('');
    });

    it('should return an empty object with a string containing only the start and end characters', () => {
        let obj = parse('\x02\x03', 0x02, 0x03);
        expect(obj.type).toEqual('');
        expect(obj.data).toEqual({});
        expect(obj.code).toEqual('');
    });

    describe('should not parse codes', () => {
        it('with bad start characters', () => {
            let badStart = parse('\x03p 123', 0x02, 0x03);
            let badStartGoodEnd = parse('\x04p 123\x03', 0x02, 0x03);
            let badStartBadEnd = parse('\x03p 123\x04', 0x02, 0x03);
            expect(badStart.type).toEqual('');
            expect(badStart.data).toEqual({});
            expect(badStart.code).toEqual('');
            expect(badStart.error).toMatch('failed to match code. bad start or end characters?');
            expect(badStartGoodEnd.type).toEqual('');
            expect(badStartGoodEnd.data).toEqual({});
            expect(badStartGoodEnd.code).toEqual('');
            expect(badStartGoodEnd.error).toMatch('failed to match code. bad start or end characters?');
            expect(badStartBadEnd.type).toEqual('');
            expect(badStartBadEnd.data).toEqual({});
            expect(badStartBadEnd.code).toEqual('');
            expect(badStartBadEnd.error).toMatch('failed to match code. bad start or end characters?');
        });

        it('with bad end characters', () => {
            let badEnd = parse('p 123\x04', 0x02, 0x03);
            let goodStartBadEnd = parse('\x02p 123\x04', 0x02, 0x03);
            expect(badEnd.type).toEqual('');
            expect(badEnd.data).toEqual({});
            expect(badEnd.code).toEqual('');
            expect(badEnd.error).toMatch('failed to match code. bad start or end characters?');
            expect(goodStartBadEnd.error).toMatch('failed to match code. bad start or end characters?');
            expect(goodStartBadEnd.type).toEqual('');
            expect(goodStartBadEnd.data).toEqual({});
            expect(goodStartBadEnd.code).toEqual('');
            expect(goodStartBadEnd.error).toMatch('failed to match code. bad start or end characters?');
        });
    });

    describe('should parse patient barcodes', () => {
        it('of varying id length', () => {
            let obj = parse('p 123456', 0x02, 0x03);
            let objShortId = parse('p 1', 0x02, 0x03);
            let objLongId = parse('p 1234567890', 0x02, 0x03);
            expect(obj.type).toEqual('patient');
            expect(obj.data).toEqual({medical_record_number: 123456});
            expect(obj.code).toEqual('barcode');
            expect(obj.error).toBeUndefined();
            expect(objShortId.type).toEqual('patient');
            expect(objShortId.data).toEqual({medical_record_number: 1});
            expect(objShortId.code).toEqual('barcode');
            expect(objShortId.error).toBeUndefined();
            expect(objLongId.type).toEqual('patient');
            expect(objLongId.data).toEqual({medical_record_number: 1234567890});
            expect(objLongId.code).toEqual('barcode');
            expect(objLongId.error).toBeUndefined();
        });

        it('with a start character', () => {
            let obj = parse('\x02p 123456', 0x02, 0x03);
            expect(obj.type).toEqual('patient');
            expect(obj.data).toEqual({medical_record_number: 123456});
            expect(obj.code).toEqual('barcode');
            expect(obj.error).toBeUndefined();
        });

        it('with an end character', () => {
            let obj = parse('\x02p 123456\x03', 0x02, 0x03);
            expect(obj.type).toEqual('patient');
            expect(obj.data).toEqual({medical_record_number: 123456});
            expect(obj.code).toEqual('barcode');
            expect(obj.error).toBeUndefined();
        });

        it('with both', () => {
            let obj = parse('\x02p 123456\x03', 0x02, 0x03);
            expect(obj.type).toEqual('patient');
            expect(obj.data).toEqual({medical_record_number: 123456});
            expect(obj.code).toEqual('barcode');
            expect(obj.error).toBeUndefined();
        });
    });

    describe('should parse medication barcodes', () => {
        it('of varying id length', () => {
            let obj = parse('m 123456', 0x02, 0x03);
            let objShortId = parse('m 1', 0x02, 0x03);
            let objLongId = parse('m 1234567890', 0x02, 0x03);
            expect(obj.type).toEqual('medication');
            expect(obj.data).toEqual({medication_id: 123456});
            expect(obj.code).toEqual('barcode');
            expect(obj.error).toBeUndefined();
            expect(objShortId.type).toEqual('medication');
            expect(objShortId.data).toEqual({medication_id: 1});
            expect(objShortId.code).toEqual('barcode');
            expect(objShortId.error).toBeUndefined();
            expect(objLongId.type).toEqual('medication');
            expect(objLongId.data).toEqual({medication_id: 1234567890});
            expect(objLongId.code).toEqual('barcode');
            expect(objLongId.error).toBeUndefined();
        });

        it('with a start character', () => {
            let obj = parse('\x02m 123456', 0x02, 0x03);
            expect(obj.type).toEqual('medication');
            expect(obj.data).toEqual({medication_id: 123456});
            expect(obj.code).toEqual('barcode');
            expect(obj.error).toBeUndefined();
        });

        it('with an end character', () => {
            let obj = parse('\x02m 123456\x03', 0x02, 0x03);
            expect(obj.type).toEqual('medication');
            expect(obj.data).toEqual({medication_id: 123456});
            expect(obj.code).toEqual('barcode');
            expect(obj.error).toBeUndefined();
        });

        it('with both', () => {
            let obj = parse('\x02m 123456\x03', 0x02, 0x03);
            expect(obj.type).toEqual('medication');
            expect(obj.data).toEqual({medication_id: 123456});
            expect(obj.code).toEqual('barcode');
            expect(obj.error).toBeUndefined();
        });
    });

    describe('should not parse barcodes', () => {
        it('with invalid types', () => {
            let obj = parse('b 123', 0x02, 0x03);
            expect(obj.type).toEqual('');
            expect(obj.data).toEqual({});
            expect(obj.code).toEqual('barcode');
            expect(obj.error).toMatch(/unknown barcode type. barcode =.*/);
        });

        it('with invalid ids', () => {
            let obj = parse('p fail', 0x02, 0x03);
            expect(obj.type).toEqual('');
            expect(obj.data).toEqual({});
            expect(obj.code).toEqual('barcode');
            expect(obj.error).toMatch(/barcode id must be a number. barcode =.*/);
        });

    });

    describe('should parse patient QR codes', () => {
        it('with all fields', () => {
            let obj = parse('605065;Garcia;Maria;1/26/19XX;Female;5\'3";130lbs;Flu;none;regular;Dr. Andrews;302', 0x02, 0x03);
            expect(obj.type).toEqual('patient');
            expect(obj.data).toEqual({
                medical_record_number: '605065',
                last_name: 'Garcia',
                first_name: 'Maria',
                date_of_birth: '1/26/19XX',
                sex: 'Female',
                height: '5\'3"',
                weight: '130lbs',
                diagnosis: 'Flu',
                allergies: 'none',
                code_status: 'regular',
                physician: 'Dr. Andrews',
                room: '302'
            });
            expect(obj.code).toEqual('qr');
            expect(obj.error).toBeUndefined();
        });

        it('with some fields', () => {
            let obj = parse('605065;;;;;;;;;;;', 0x02, 0x03);
            expect(obj.type).toEqual('patient');
            expect(obj.data).toEqual({
                medical_record_number: '605065',
                last_name: '',
                first_name: '',
                date_of_birth: '',
                sex: '',
                height: '',
                weight: '',
                diagnosis: '',
                allergies: '',
                code_status: '',
                physician: '',
                room: ''
            });
            expect(obj.code).toEqual('qr');
            expect(obj.error).toBeUndefined();
        });

        it('with only MRN', () => {
        });

        it('with a start character', () => {
            let obj = parse('\x02605065;Garcia;Maria;1/26/19XX;Female;5\'3";130lbs;Flu;none;regular;Dr. Andrews;302', 0x02, 0x03);
            expect(obj.type).toEqual('patient');
            expect(obj.data).toEqual({
                medical_record_number: '605065',
                last_name: 'Garcia',
                first_name: 'Maria',
                date_of_birth: '1/26/19XX',
                sex: 'Female',
                height: '5\'3"',
                weight: '130lbs',
                diagnosis: 'Flu',
                allergies: 'none',
                code_status: 'regular',
                physician: 'Dr. Andrews',
                room: '302'
            });
            expect(obj.code).toEqual('qr');
            expect(obj.error).toBeUndefined();
        });

        it('with an end character', () => {
            let obj = parse('605065;Garcia;Maria;1/26/19XX;Female;5\'3";130lbs;Flu;none;regular;Dr. Andrews;302\x03', 0x02, 0x03);
            expect(obj.type).toEqual('patient');
            expect(obj.data).toEqual({
                medical_record_number: '605065',
                last_name: 'Garcia',
                first_name: 'Maria',
                date_of_birth: '1/26/19XX',
                sex: 'Female',
                height: '5\'3"',
                weight: '130lbs',
                diagnosis: 'Flu',
                allergies: 'none',
                code_status: 'regular',
                physician: 'Dr. Andrews',
                room: '302'
            });
            expect(obj.code).toEqual('qr');
            expect(obj.error).toBeUndefined();
        });

        it('with both', () => {
            let obj = parse('\x02605065;Garcia;Maria;1/26/19XX;Female;5\'3";130lbs;Flu;none;regular;Dr. Andrews;302\x03', 0x02, 0x03);
            expect(obj.type).toEqual('patient');
            expect(obj.data).toEqual({
                medical_record_number: '605065',
                last_name: 'Garcia',
                first_name: 'Maria',
                date_of_birth: '1/26/19XX',
                sex: 'Female',
                height: '5\'3"',
                weight: '130lbs',
                diagnosis: 'Flu',
                allergies: 'none',
                code_status: 'regular',
                physician: 'Dr. Andrews',
                room: '302'
            });
            expect(obj.code).toEqual('qr');
            expect(obj.error).toBeUndefined();
        });
    });

    describe('should parse medication QR codes', () => {
        it('with full fields', () => {
            let obj = parse('Hydrocodone Bitartate;5;milligrams;Acetaminophen;325;milligrams;combo;', 0x02, 0x03);
            expect(obj.type).toEqual('medication');
            expect(obj.data).toEqual({
                name: 'Hydrocodone Bitartate',
                dosage_amount: '5',
                dosage_unit: 'milligrams',
                secondary_name: 'Acetaminophen',
                second_amount: '325',
                second_unit: 'milligrams',
                second_type: 'combo',
                comments: '',
            });
            expect(obj.code).toEqual('qr');
            expect(obj.error).toBeUndefined();
        });

        it('with some fields', () => {
            let obj = parse('Hydrocodone Bitartate;5;milligrams;;;;;', 0x02, 0x03);
            expect(obj.type).toEqual('medication');
            expect(obj.data).toEqual({
                name: 'Hydrocodone Bitartate',
                dosage_amount: '5',
                dosage_unit: 'milligrams',
                secondary_name: '',
                second_amount: '',
                second_unit: '',
                second_type: '',
                comments: '',
            });
            expect(obj.code).toEqual('qr');
            expect(obj.error).toBeUndefined();
        });

        it('with only name', () => {
            let obj = parse('Hydrocodone Bitartate;;;;;;;', 0x02, 0x03);
            expect(obj.type).toEqual('medication');
            expect(obj.data).toEqual({
                name: 'Hydrocodone Bitartate',
                dosage_amount: '',
                dosage_unit: '',
                secondary_name: '',
                second_amount: '',
                second_type: '',
                second_unit: '',
                comments: '',
            });
            expect(obj.code).toEqual('qr');
            expect(obj.error).toBeUndefined();
        });

        it('with a start character', () => {
            let obj = parse('\x02Hydrocodone Bitartate;5;milligrams;Acetaminophen;325;milligrams;combo;', 0x02, 0x03);
            expect(obj.type).toEqual('medication');
            expect(obj.data).toEqual({
                name: 'Hydrocodone Bitartate',
                dosage_amount: '5',
                dosage_unit: 'milligrams',
                secondary_name: 'Acetaminophen',
                second_amount: '325',
                second_unit: 'milligrams',
                second_type: 'combo',
                comments: '',
            });
            expect(obj.code).toEqual('qr');
            expect(obj.error).toBeUndefined();
        });

        it('with an end character', () => {
            let obj = parse('Hydrocodone Bitartate;5;milligrams;Acetaminophen;325;milligrams;combo;\x03', 0x02, 0x03);
            expect(obj.type).toEqual('medication');
            expect(obj.data).toEqual({
                name: 'Hydrocodone Bitartate',
                dosage_amount: '5',
                dosage_unit: 'milligrams',
                secondary_name: 'Acetaminophen',
                second_amount: '325',
                second_unit: 'milligrams',
                second_type: 'combo',
                comments: '',
            });
            expect(obj.code).toEqual('qr');
            expect(obj.error).toBeUndefined();
        });

        it('with both', () => {
            let obj = parse('\x02Hydrocodone Bitartate;5;milligrams;Acetaminophen;325;milligrams;combo;\x03', 0x02, 0x03);
            expect(obj.type).toEqual('medication');
            expect(obj.data).toEqual({
                name: 'Hydrocodone Bitartate',
                dosage_amount: '5',
                dosage_unit: 'milligrams',
                secondary_name: 'Acetaminophen',
                second_amount: '325',
                second_unit: 'milligrams',
                second_type: 'combo',
                comments: '',
            });
            expect(obj.code).toEqual('qr');
            expect(obj.error).toBeUndefined();
        });
    });

    describe('should not parse QR codes', () => {
        it('with 9-12 fields', () => {
            let obj = parse('605065;Garcia;Maria;1/26/19XX;Female;5\'3";130lbs;Flu;none', 0x02, 0x03);
            expect(obj.type).toEqual('');
            expect(obj.data).toEqual({});
            expect(obj.code).toEqual('qr');
            expect(obj.error).toMatch(/Patient QR code is missing fields. length=.* expected=12/);
        });

        it('with less than 8 fields', () => {
            let obj = parse('Hydrocodone Bitartate;;;;;', 0x02, 0x03);
            expect(obj.type).toEqual('');
            expect(obj.data).toEqual({});
            expect(obj.code).toEqual('qr');
            expect(obj.error).toMatch(/QR code is missing fields. length=.*/);
        });

        it('without a first field', () => {
            let obj = parse(';;;;;;;', 0x02, 0x03);
            expect(obj.type).toEqual('');
            expect(obj.data).toEqual({});
            expect(obj.code).toEqual('qr');
            expect(obj.error).toMatch(/QR code is missing a required name attribute. code = .*/);
        });
    });
});
