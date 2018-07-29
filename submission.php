<?php

session_start();

$_SESSION['url'] = $_SERVER['REQUEST_URI'];
require_once("config.php");
if(!isset($_SESSION['un']))
{
  header("Location:login.php");
}
if(isset($_SESSION['un']))
{
  $username=$_SESSION['un'];
}




?>


<!DOCTYPE html>
<html>
<head>
  
    
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>All Submission</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>







</head>
<body>
<div class="main">
<div class="row">
<div class="col-sm-12">
<nav class="navbar navbar-inverse navbar-fixed-top nbar">
    <div class="navbar-header">
      <a class="navbar-brand lspace" href="home.php">RUET OJ</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="space"><a href="#"><i class="fa fa-code ispace"></i>Compiler</a></li>
      <li class="space"><a href="archive.php"><i class="fa fa-archive ispace"></i>Problem Archive</a></li>
      <li class="space"><a href="#"><i class="fa fa-cogs ispace"></i>Contests</a></li>
      <li class="space"><a href="#"><i class="fa fa-check-square ispace"></i>Debug</a></li>
      <li class="lgspace space"><a href="profile.php?user=<?php echo("$username"); ?>"><i class="fa fa-user ispace"></i><?php echo("$username"); ?></a></li>
      
    </ul>
  
</nav>
</div>
</div>


<div class="row log">
<div class="col-sm-10">
<div class=""><h3 style="text-align:center;">All Submission</h3></div>
</div>

<div class="col-sm-1">

</div>

<div class="col-sm-1">
  
</div>

</div>




<div class="row cspace">
<div class="col-sm-9">
  <div class="table-responsive">
    <table class="table">
    <thead>
    <tr>
     <th>ID</th>
     <th>Name</th>
     <th>Problem Name</th>
     <th>Verdict</th>
    </tr>
    </thead>
    <tbody>
<?php


error_reporting(0);
if(isset($_POST['result']))
{
  $uo=$_POST['result'];
  $ao=$_POST['ac'];
  $pname=$_POST['pb'];
}

$ch=1;

if(!isset($uo))
{
   $ch=0;
   error_reporting(0);
   $show="SELECT * FROM submission ORDER BY sid DESC";
   $sts=mysqli_query($con,$show);



while($row=mysqli_fetch_array($sts))
{

	echo "<tr><td><a href=\"showcode.php?id=$row[sid]&nm=$row[sname]\">$row[sid]</a></td><td><a href=\"profile.php?user=$row[sname]\">$row[sname]</a></td><td><a href=\"description.php?name=$row[pbname]\">$row[pbname]</a></td><td>$row[verdict]</td></tr>";
}




}


if(isset($uo))
{

//var_dump($uo);

$l=strlen($uo)-2;


$m=strlen($ao);



//var_dump($ao);




if(strcmp($uo,$ao)==0)
{
  //echo "Accepted";
	$result="Accepted";
}
else
{
  //echo "Wrong Answer";
	$result="Wrong Answer";
}



$sql="INSERT INTO submission VALUES('','$username','$result','$pname') ";
$show="SELECT * FROM submission ORDER BY sid DESC";

$stq=mysqli_query($con,$sql);
$sts=mysqli_query($con,$show);



while($row=mysqli_fetch_array($sts))
{

	
echo "<tr><td><a href=\"showcode.php?id=$row[sid]&nm=$row[sname]\">$row[sid]</a></td><td><a href=\"profile.php?user=$row[sname]\">$row[sname]</a></td><td><a href=\"description.php?name=$row[pbname]\">$row[pbname]</a></td><td>$row[verdict]</td></tr>";


}

}
?>

</tbody>
</table>
</div>


</div>

<div class="col-sm-3">

</div>
</div>
</div>
</div><br><br><br>

<div class="area">
<div class="well foot">
<div class="row area">
<div class="col-sm-3">
</div>

<div class="col-sm-5">


<div class="fm">

<b>Beta Version-2016</b><br>
<b>Developed By Ashadullah Shawon</b>

</div>
</div>


<div class="col-sm-4">
<?php

require_once("time.php");

?>
</div>
</div>
</div>
</div>



</body>
</html>
