window.onscroll = function() {scrollFunction()};
window.onload = function() {loadFunction()};
window.onresize = function() {resizeFunction();}

function loadFunction() {
	var h1 = document.getElementById("topContainer").offsetHeight;
	h2 = 0;
	var h2 = document.getElementById("collapsed_menu").offsetHeight;
	var h3 = h1+h2;

	document.getElementById("collapsed_menu").style.marginTop = h1.toString() + "px";
	document.getElementById("secondBand").style.marginTop = h3.toString() + "px";
}

function resizeFunction() {
	var h1 = document.getElementById("topContainer").offsetHeight;
	h2 = 0;
	var h2 = document.getElementById("collapsed_menu").offsetHeight;
	var h3 = h1+h2;

	document.getElementById("collapsed_menu").style.marginTop = h1.toString() + "px";
	document.getElementById("secondBand").style.marginTop = h3.toString() + "px";
}

function topFunction() {
	document.body.scrollTop = 0; // For Chrome, Safari and Opera 
	document.documentElement.scrollTop = 0; // For IE and Firefox
}

function reloadFunction(){
	location.reload();
}

function openTab(tabName){
    var i;
    var x = document.getElementsByClassName("tab");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(tabName).style.display = "block";  
}

function openTabProg(tabName,tabButton){
    var i;
    var x = document.getElementsByClassName("tabProg");
    var y = document.getElementsByClassName("tabProgButton");

	for (i=0; i<x.length; i++){
		x[i].style.display = "none";
		y[i].className = "w3-bar-item tabProgButton w3-button w3-border";
	}

    document.getElementById(tabName).style = "";
    y[tabButton].className += " w3-theme";
}

function w3_open() {
	document.getElementById("mySidebar").className += " w3-top";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
	document.getElementById("mySidebar").className = document.getElementById("mySidebar").className.replace(" w3-top","");
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

function openAbstract(abstract_id){
	document.getElementById(abstract_id).style.display = "block";
}
