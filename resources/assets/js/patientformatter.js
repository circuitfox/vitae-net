$('#patient-format').on('click', () => {
    var mrn = $('#mrn').val();
    var lname = $('#lname').val();
    var fname = $('#fname').val();
    var dob = $('#dob').val();
    var sex = $('#sex').val();
    var height = $('#height').val();
    var weight = $('#weight').val();
    var diagnosis = $('#diagnosis').val();
    var allergies = $('#allergies').val();
    var code = $('#code').val();
    var physician = $('#physician').val();
    var room = $('#room').val();
    $('#output').html(
        mrn + ';' + lname + ';' + fname + ';' +
        dob + ';' + sex + ';' + height + ';' +
        weight + ';' + diagnosis + ';' + allergies + ';' +
        code + ';' + physician + ';' + room
    );
});
