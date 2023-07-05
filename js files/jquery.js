reloader();
$(document).ready(function () {
  
    $('#assettable12').DataTable();
    reloader();
});
$(document).ready(function () {
  
    $('#assettable11').DataTable();
    reloader();
});
$(document).ready(function () {
  
    $('#assettable10').DataTable();
    reloader();
});
$(document).ready(function () {
  
    $('#assettable9').DataTable();
    reloader();
});
$(document).ready(function () {
  
    $('#assettable8').DataTable();
    reloader();
});
$(document).ready(function () {
  
    $('#assettable7').DataTable();
    reloader();
});
$(document).ready(function () {
  
    $('#assettable6').DataTable();
    reloader();
});
$(document).ready(function () {
  
    $('#assettable5').DataTable();
    reloader();
});
$(document).ready(function () {
  
    $('#assettable4').DataTable();
    reloader();
});
$(document).ready(function () {
  
    $('#assettable3').DataTable();
    reloader();
});
$(document).ready(function () {
  
    $('#assettable2').DataTable();
    reloader();
});

$(document).ready(function () {
    
    $('#assettable').DataTable();
     reloader();
});

function reloader() {

    window.ready;
}

const btn = document.querySelector('#nav-computers-tab');
btn.addEventListener('click', reloader());

function showtext() {
    var dropdownval = document.getElementById('category').value;
        if (dropdownval.toLowerCase() == "vehicles") {
            document.getElementById('uniquecodelabel').innerHTML = "Vin Number/Code";
        }
        else {
            document.getElementById('uniquecodelabel').innerHTML = "Serial Number";
        }
}




