document.getElementById("format").addEventListener('click', function(){
  var pname = document.getElementById("primary_name").value;
  var pamount = document.getElementById("primary_amount").value;
  var punit = document.getElementById("primary_unit").value;
  var sname = document.getElementById("secondary_name").value;
  var samount = document.getElementById("second_amount").value;
  var sunit = document.getElementById("second_unit").value;
  var stype = document.getElementById("second_type").value;
  var comm = document.getElementById("comments").value;
  document.getElementById("output").innerHTML = pname + ';' + pamount + ';' +
      punit + ';' + sname + ';' + samount + ';' + sunit + ';' +
      stype + ';' + comm;
});
