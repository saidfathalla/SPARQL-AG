<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style type="text/css">
<!--
.style5 {color: #CC0000}
-->
</style>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>SPRQL-AG </title>
        <style>
		/* syle the page*/
		* {
  box-sizing: border-box;
}


/* Style the header */
.header {
  background-color: #f1f1f1;
  background-image: url("https://codyburleson.com/wp-content/uploads/2018/07/sparql-sql-for-sem-web-0.png");
   background-repeat: no-repeat;
    background-size: 120px 120px;
  padding: 20px;
  text-align: center;
}

/* Style the top navigation bar */
.topnav {
  overflow: hidden;
  background-color: #333;
}

/* Style the topnav links */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Create three unequal columns that floats next to each other */
.column {
  float: left;
  padding: 10px;
}

/* Left and right column */
.column.side {
  width: 10%;
}

/* Middle column */
.column.middle {
  width: 78%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column.side, .column.middle {
    width: 100%;
  }
}
		
		
		
            .error {color: #FF0000;}
            .style2 {  font-style: italic; }
			
/*			input[type=text], input[type=date], select {
  background-color: #3CBC8D;
  color: white;
   width: 10%;
}*/
 

textarea:focus {
  width: 95%;
}			
textarea{
  width: 70%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}
			input[type=submit], button {
  width: 10%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=submit]:hover, button:hover {
  background-color: #45a049;
  font-weight:bold
}
        .style3 {
	font-size: large;
	font-weight: bold;
}
        .style4 {font-size: large}
        </style>

 
</head>


    <body>
	<div class="header">
	  <h1>SPARQL-AG service</h1>
      <p>A SPARQL auto-generation service for  EVENTSKG SPARQL endpoint </p>
  </div>

    <div class="topnav">
  <a href="http://kddste.sda.tech/EVENTSKG-Dataset/EVENTSKG_R2.html">EVENTSKG Homepage </a>
  <a href="#">Issue Tracker</a>
  <a href="#">SPARQL endpoint</a>
  <a href="#">Live Demo</a>
  </div>
<div class="row">
  <div class="column side">
    <h2>&nbsp;</h2>
    <p>&nbsp;</p>
  </div>


       
		
<div class="column middle">
        
            <p>&nbsp;</p>
  </div>
  <div class="column side">
    <h2>&nbsp;</h2>
  </div>
	</div>
        <script>
           
   function generateAlias(){
         document.getElementById('asVal').value = document.getElementById('selFnCol').value+  "_"+ document.getElementById('selFn').value  ;
    }
    function getVal(hiddenId,textareaID)
    {
        document.getElementById(hiddenId).value = document.getElementById(textareaID).value ;
    }
function KeyPress(e) { 
e = e || window.event;
var key = e.keyCode ? e.keyCode : e.which;
if (key == 13) {
e.preventDefault();
 document.getElementById("prefix").value += "\n PREFIX ";
}
}
function copy(id) {
let textarea = document.getElementById(id);
textarea.select();
document.execCommand("copy");
}
function addAggregationFnToHaving() { // automaticll add Agg fun to having
// Get the checkbox
var checkBox = document.getElementById("selHaving");
// Get the output text
var text = document.getElementById("HavingColVal");

// If the checkbox is checked, display the output text
if (checkBox.checked == true){
text.value = document.getElementById("selFn").value+"("+document.getElementById("selFnCol").value+")";
} else {
text.value = "";
}
}
function addAggregationColToGroupBy() { // automaticll add Agg fun to having
// Get the checkbox
var checkBox = document.getElementById("selAggCol");
// Get the output text
var text = document.getElementById("groupbyVal1");

// If the checkbox is checked, display the output text
if (checkBox.checked == true){
text.value = document.getElementById("aggColVal").value;
document.getElementById("selGroupBy1").checked=true;

} else {
text.value = "";
document.getElementById("selGroupBy1").checked=false;

}
}
function validateQuery(){
 
alert("No errors.")

}
function myFunction(dv1,dv2,sel) {
  var x = document.getElementById(dv1);
  var y = document.getElementById(dv2);
var s = document.getElementById(sel).value;
  if (x.style.display === "none" && s=="btn" ) {
    x.style.display = "block";
	y.style.display = "block";
  } else {
    x.style.display = "none";
	y.style.display = "none";
  }
}

        </script>
</body>
                                                                                        </html>
