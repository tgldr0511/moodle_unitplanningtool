document.getElementById("id_department").addEventListener("change", redirFunc);
function redirFunc(){
	var dep = document.getElementById("id_department");
	alert(dep.value);
}
console.log("updated");