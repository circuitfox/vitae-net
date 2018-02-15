$('#med-format').on('click', () => {
    var pname = $('#primary_name').val();
    var pamount = $('#primary_amount').val();
    var punit = $('#primary_unit').val();
    var sname = $('#secondary_name').val();
    var samount = $('#second_amount').val();
    var sunit = $('#second_unit').val();
    var stype = $('#second_type').val();
    var comm = $('#comments').val();
    console.log(
      pname + ';' + pamount + ';' + punit + ';' +
      sname + ';' + samount + ';' + sunit + ';' +
      stype + ';' + comm
    );
    $('#output').html(
      pname + ';' + pamount + ';' + punit + ';' +
      sname + ';' + samount + ';' + sunit + ';' +
      stype + ';' + comm
    );
});
