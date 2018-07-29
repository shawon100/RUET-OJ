
<?php
require_once("connection.php");

error_reporting(0);

$table=$_POST['pb'];
$v=$_POST['c1'];

error_reporting(0);


$q1="CREATE TABLE $table( value VARCHAR(50000))";
$q2="INSERT into $table VALUES('$v')";

$sq1=mysqli_query($con,$q1);
$sq2=mysqli_query($con,$q2);




if($sq1 && $sq2)
{
	$sqq="SELECT * FROM  $table";

    $r=mysqli_query($con,$sqq);

   /*while($row=mysqli_fetch_array($r))
   {
     echo("$row[value]");
   }*/

}




?>

<!DOCTYPE html>
<html>
<head>
	<title>Save</title>
</head>
<body>

<div style="margin-left:600px;">
<b><span style="font-size:25px;">Problem List</span></b><br><br>
<?php

require_once("connection.php");

$q6="SELECT table_name FROM information_schema.tables where table_schema='problem' ";

$res=mysqli_query($con,$q6);

while($row=mysqli_fetch_array($res))
{
	error_reporting(0);
	echo '<form action="test.php" method="POST"> <input type="hidden" name="pb" value="' . htmlspecialchars($row[table_name]) . '" /><input type="submit" value=" ' . htmlspecialchars($row[table_name]) .'  "/></form>'."<br>";
}


?>
</div>

</body>
</html>

