<?php

//header('Content-Type:application/json');
session_start();
require_once("config.php");

if(!isset($_SESSION["un"]))
{
  header("Location:login.php");
}

if(isset($_SESSION['un']))
{
  $username=$_SESSION['un'];

}

if(isset($_GET['user']))
{
	$name=$_GET['user'];
}

//$qq='SELECT value from world';
//$rq=mysqli_query($con,$qq);

//$row=mysqli_fetch_array($rq);


//$us=$row['value'];


$ac="SELECT COUNT(verdict) AS verdict FROM submission where verdict='Accepted' and sname='$username'";
$wa="SELECT COUNT(verdict) AS verdict FROM submission where verdict='Wrong Answer' and sname='$username'";
$tle="SELECT COUNT(verdict) AS verdict FROM submission where verdict='Time Limit Exceed' and sname='$username'";

$s1=mysqli_query($con,$ac);
$s2=mysqli_query($con,$wa);
$s3=mysqli_query($con,$tle);

//$nac=mysqli_fetch_array($s1);
//$nwa=mysqli_fetch_array($s2);
//$ntle=mysqli_fetch_array($s3);

$data=array();
$result=array();



//$data[]=$nwa['verdict'];
//$data[]=$ntle['verdict'];




foreach($s1 as $nac)
{
	$data[]=$nac;
	//$i++;
}


foreach($s2 as $nwa)
{
	$data[]=$nwa;
	//$i++;
}

foreach($s3 as $ntle)
{
	$data[]=$ntle;
	//$i++;
}





print json_encode($data);

//header("Location:profile.php?name=$name");


/*foreach($data as $value) {
	//echo($value['verdict']);
	array_push($result,$value['verdict']);

}

print json_encode($result,JSON_FORCE_OBJECT);*/








?>