function redirFc(){
	var dep = document.getElementById("id_department");
	console.log(dep.value);
	window.location.replace("./view.php?id="+dep.value);
}

function refreshPage(){
	location.reload();
}
document.addEventListener('DOMContentLoaded', function () {
	var el = document.getElementById("id_department");
	if(el){
		el.addEventListener("change", redirFc, false);
	}
});

$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
); 

