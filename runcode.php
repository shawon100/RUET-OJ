<?php

session_start();
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
        <title>Run Code</title>
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
      <a class="navbar-brand lspace" href="#">Home</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="space"><a href="#"><i class="fa fa-code ispace"></i>Compiler</a></li>
      <li class="space"><a href="archive.php"><i class="fa fa-archive ispace"></i>Problem Archive</a></li>
      <li class="space"><a href="#"><i class="fa fa-cogs ispace"></i>Contests</a></li>
      <li class="space"><a href="#"><i class="fa fa-check-square ispace"></i>Debug</a></li>
      <li class="lgspace space"><a href="profile.php?user=<?php echo("$username"); ?>"><i class="fa fa-user ispace"></i><?php echo("$username"); ?></a></li>
       <li class="space"><a href="logout.php"><i class="fa fa-power-off ispace"></i>Logout</a></li>
      
    </ul>
  
</nav>
</div>
</div>


<div class="row log">
<div class="col-sm-10">
<div class=""><h3 style="text-align:center;">Code Compiler</h3></div>
</div>

<div class="col-sm-1">

</div>

<div class="col-sm-1">
  
</div>

</div>

<div class="row cspace">
<div class="col-sm-8">


<?php
//Import the SDK 

require("config.php");
require_once("/path/sdk/index.php");




//Setting up the Hackerearth API
$hackerearth = Array(
		'client_secret' => '16a9520253721a46a15f22e083abe1274762020d', //(REQUIRED) Obtain this by registering your app at http://www.hackerearth.com/api/register/
        'time_limit' => '5',   //(OPTIONAL) Time Limit (MAX = 5 seconds )
        'memory_limit' => '262144'  //(OPTIONAL) Memory Limit (MAX = 262144 [256 MB])
	);

//Feeding Data Into Hackerearth API

$lang=$_POST['lan'];
$source=$_POST['src'];
//$input=$_POST['in'];
$pb=$_POST['pbn'];
$pid=$_POST['id'];
$us=$_SESSION['un'];


$isql="SELECT tc FROM archieve WHERE id='$pid'";
$si=mysqli_query($con,$isql);
$r4=mysqli_fetch_array($si);

$input=$r4['tc'];




$config = Array();
$config['time']='5';	 	//(OPTIONAL) Your time limit in integer and in unit seconds
$config['memory']='262144'; //(OPTIONAL) Your memory limit in integer and in unit kb
$config['source']=$source;    	//(REQUIRED) Your formatted source code for which you want to use hackerEarth api, leave this empty if you are using file
$config['input']=$input;     	//(OPTIONAL) formatted input against which you have to test your source code
$config['language']=$lang;  //(REQUIRED) Choose any one of the below
						 	// C, CPP, CPP11, CLOJURE, CSHARP, JAVA, JAVASCRIPT, HASKELL, PERL, PHP, PYTHON, RUBY

//Sending request to the API to compile and run and record JSON responses
$response = run($hackerearth,$config);     // Use this $response the way you want , it consists data in PHP Array
//Printing the response
//echo"<pre>".print_r($response,1)."</pre>";






$sql="SELECT output FROM archieve WHERE id='$pid'";

$sq=mysqli_query($con,$sql);
$row=mysqli_fetch_array($sq);
$str="";
$ch=1;

if($response)
{

foreach($response as $value){

    
     if(isset($value['output']))
     {
       $str=$value['output'];
      

      
     //echo "Your Code has Been Submitted.Click Below To Show Result<br><br>";
      

      // echo "<div style=\"margin-left:300px;\"><form action=\"submission.php\" method=\"POST\"><textarea style=\"display:none\" name=\"result\" rows=\"10\" cols=\"10\">$value[output]</textarea><textarea style=\"display:none\" name=\"ac\" rows=\"10\" cols=\"10\">$row[output]</textarea><input type=\"hidden\" name=\"pb\" value=\"$pb\"><input class=\"btn btn-success tm\" type=\"submit\" value=\"Show Result\"> </div>";
      if(error_reporting(1))
      {
        break;
      }
    }
    else
    {
         echo "<div style=\"margin-left:250px;\" class=\"alert alert-danger\">
  <strong>Compilation Error Or Submit Failed!</strong> Back To Problem Description And Submit Code Again.
   </div><br>";
       $ch=0;
       //error_reporting(0);
       break;
    }
      

    
      
     

     
}

if(error_reporting(0))
{


$nsql="INSERT into code VALUES('$us','$source','')";
$usql="UPDATE archieve SET uoutput='$str' WHERE id='$pid'";
$csql="SELECT uoutput FROM archieve WHERE id='$pid'";
$q3="SELECT id FROM code ORDER BY id DESC ";
$snq=mysqli_query($con,$nsql);
$snd=mysqli_query($con,$usql);
$cnd=mysqli_query($con,$csql);
$sq3=mysqli_query($con,$q3);
$r2=mysqli_fetch_array($cnd);
$r4=mysqli_fetch_array($sq3);




$uo=$r2['uoutput'];
$ac=$row['output'];
$nid=$r4['id'];

//var_dump($uo);
//echo "<br><br>";
//var_dump($ac);


//echo "$uo<br>";

if(strcmp($uo,$ac)==0)
{
  $fr="Accepted";
}
else
{
  $fr="Wrong Answer";
}

//echo "$fr<br>";
  
  if($ch==1)
  {
    echo "<div style=\"margin-left:250px;\" class=\"alert alert-success\">
  <strong>Successfully Compiled!</strong> Click Below Submit Button To Submit.
   </div><br>";
  }



 echo "<div style=\"margin-left:300px;\"><form action=\"allsubmission.php\" method=\"POST\"><input type=\"hidden\" name=\"pb\" value=\"$pb\"><input type=\"hidden\" name=\"id\" value=\"$pid\"><input type=\"hidden\" name=\"mid\" value=\"$nid\"><input type=\"hidden\" name=\"vd\" value=\"$fr\"><textarea style=\"display:none\" name=\"result\" rows=\"10\" cols=\"10\">$value[output]</textarea><input class=\"btn btn-success tm\" type=\"submit\" value=\"Submit Code\"> </div>";
}
else
{
         echo "<div style=\"margin-left:250px;\" class=\"alert alert-danger\">
  <strong>Compilation Error Or Submit Failed!</strong> Back To Problem Description And Submit Code Again.
   </div><br>";
}
}
else
{
          echo "<div style=\"margin-left:250px;\" class=\"alert alert-danger\">
  <strong>There is No Internet Connection!</strong> Check Your Connection And Fix It.
   </div><br><br><br><br>";
}



/*var_dump($str);



$out=$row['output'];
$m=strlen($out);



var_dump($out);



if(strcmp($str,$out)==0)
{

  echo "Accepted";
}
else
{
  echo "Wrong Answer";
}

*/



?>

</div>
<div class="col-sm-4">

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

</div>
</div>
</div>
</div>



</body>
</html>