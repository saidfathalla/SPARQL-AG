<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>


<form action="#" method="post">
<select name="Color">
<option value="Red">Red</option>
<option value="Green">Green</option>
<option value="Blue">Blue</option>
<option value="Pink">Pink</option>
<option value="Yellow">Yellow</option>
</select>
<input type="submit" name="submit" value="Get Selected Values" />
</form>
<?php
if(isset($_POST['submit'])){
$selected_val = $_POST['Color'];  // Storing Selected Value In Variable
echo "You have selected :" .$selected_val;  // Displaying Selected Value
}
?>


</body>
</html>
