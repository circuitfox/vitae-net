document.getElementById("format").addEventListener('click', function(){
  var mrn = document.getElementById("mrn").value;
  var lname = document.getElementById("lname").value;
  var fname = document.getElementById("fname").value;
  var dob = document.getElementById("dob").value;
  var sex = document.getElementById("sex").value;
  var height = document.getElementById("height").value;
  var weight = document.getElementById("weight").value;
  var diagnosis = document.getElementById("diagnosis").value;
  var allergies = document.getElementById("allergies").value;
  var code = document.getElementById("code").value;
  var physician = document.getElementById("physician").value;
  var room = document.getElementById("room").value;
  document.getElementById("output").innerHTML = mrn + ';' + lname + ';' +
  fname + ';' + dob + ';' + sex + ';' + height + ';'
  + weight + ';' + diagnosis + ';' + allergies + ';' + code + ';'
  + physician + ';' + room;
});
