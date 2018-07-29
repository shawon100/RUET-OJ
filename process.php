<?php

session_start();
require_once("config.php");

 
$uname=$_POST['un'];
$pw=$_POST['ps'];
$url=$_POST['uri'];
$pw=md5($pw);


$lq="SELECT * FROM `user` WHERE name='$uname' AND pass='$pw'";

$sq=mysqli_query($con,$lq);

$row=mysqli_fetch_array($sq);





if(!empty($row))
{
	

	if($uname==$row[name] && $row[pass]==$pw)
	{
       
       
           $_SESSION=array();

           $_SESSION['un']=$row[name];
            $_SESSION['ps']=$row[pass];
            

            header("Location: $url");

            



	}
	else
	{
		 header("Location:login.php?value=fail");
		 //echo "<script>window.alert(\"Wrong Username And Password\");</script>";
         //echo("Wrong Username And Password");
         echo '<script language="javascript">';
		 echo 'alert("Wrong Username And Password")';
		  echo '</script>';
	}


}
else
{
	 header("Location:login.php?value=fail");
	 //echo "<script>window.alert(\"Wrong Username And Password\");</script>";
	// echo("Wrong Username And Password");
	  echo '<script language="javascript">';
		 echo 'alert("Wrong Username And Password")';
		  echo '</script>';
}



?>