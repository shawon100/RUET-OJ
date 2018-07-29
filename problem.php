<!DOCTYPE html>
<html>
<head>
	<title>Compiler</title>
</head>
<body>

<form action="judge.php" method="POST" enctype="multipart/form-data">

<b>Choose Your Language<b><br>
<select name="lan">

<option value="1">C</option>
<option value="2">C++</option>
<option value="2">C++ 11</option>
<option value="3">Java</option>
<option value="20">Javascript</option>
<option value="7">PHP</option>
<option value="5">Python</option>
<option value="6">Perl</option>
<option value="8">Ruby</option><br><br>



<b>Upload Your File</b><br>
<input type="file" name="fu" id="fu"><br>

<b>Give Your Input Here</b><br>
<textarea name="in" rows="10" cols="50"></textarea><br>



<input type="submit" value="Submit">





</form>




</body>
</html>