<?php
session_start();
require_once("config.php");



$ac=$_POST['tu'];
$tc=$_POST['ta'];
$sc=$_POST['uc'];
$us=$_SESSION['un'];

$l=strlen($ac)-5;
$m=strlen($tc);



if($l==$m)
{
	
	//echo("Accepted");
	$result="Accepted";
} 

else if($ac==$tc)
{
	//echo("Accepted");
	$result="Accepted";
}
else
{
	/*echo($l);
	var_dump($ac);
	var_dump($tc);
	echo("Wrong Answer ".$ac);*/
	$result="Wrong Answer";
}

$sql="INSERT INTO submission VALUES('','$us', '$result') ";
$nsql="INSERT into code VALUES('us','$sc','')";
$show="SELECT * FROM submission";

$stq=mysqli_query($con,$sql);
$send=mysqli_query($con,$nsql);
$sts=mysqli_query($con,$show);



while($row=mysqli_fetch_array($sts))
{

	echo "<div style=\"margin-left:300px; margin-right:200px; padding-left:200px;border-bottom:1px solid black;\"> <a href=\"showcode.php?id=$row[sid]&nm=$row[sname]\">$row[sid]</a>.......<a href=\"profile.php?user=$row[sname]\">$row[sname]</a>---------$row[verdict]</div>";
}











?>