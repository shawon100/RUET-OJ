<?php

session_start();

if(!isset($_SESSION["un"]))
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
        <title>Home</title>
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
      <a class="navbar-brand lspace" href="home.php">RAPL</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="space"><a href="compiler.php"><i class="fa fa-code ispace"></i>Compiler</a></li>
      <li class="space"><a href="archive.php"><i class="fa fa-archive ispace"></i>Problem Archive</a></li>
      <li class="space"><a href="contest.php"><i class="fa fa-cogs ispace"></i>Contests</a></li>
      <li class="space"><a href="debug.php"><i class="fa fa-check-square ispace"></i>Debug</a></li>
      <li class="lgspace space"><a href="profile.php?user=<?php echo("$username"); ?>"><i class="fa fa-user ispace"></i><?php echo("$username"); ?></a></li>
      <li class="space"><a href="logout.php"><i class="fa fa-power-off ispace"></i>Logout</a></li>
      
    </ul>
  
</nav>
</div>
</div>


<div class="row log">
<div class="col-sm-10">
<div class=""><h3 style="text-align:center;">Output</h3></div>
</div>

<div class="col-sm-1">

</div>

<div class="col-sm-1">
  
</div>

</div>




<div class="row cspace">
<div class="col-sm-1">
</div>
<div class="col-sm-8">


<?php
//Import the SDK 
require_once("/opt/lampp/htdocs/roj/path/sdk/index.php");



//Setting up the Hackerearth API
$hackerearth = Array(
		'client_secret' => '2a7b2db3e53f28d8dfef3192532018f91c73ee47', //(REQUIRED) Obtain this by registering your app at http://www.hackerearth.com/api/register/
        'time_limit' => '5',   //(OPTIONAL) Time Limit (MAX = 5 seconds )
        'memory_limit' => '262144'  //(OPTIONAL) Memory Limit (MAX = 262144 [256 MB])
	);

//Feeding Data Into Hackerearth API

$lang=$_POST['lan'];
$source=$_POST['code'];
$input=$_POST['input'];




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

$ch=1;
$str="";
if($response)
{
foreach ($response as $value) {

      if(isset($value['output']))
      {

         $str=$value['output'];


      

       
        if(error_reporting(1))
        {
          break;
        }
      }


      else
      {
                 echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">Compilation Error Or Submit Failed! Check Your Language And Submit Code Again.</textarea><br><br>";
                 break;
                  
      }


     
      
     

     
}
}
else
{
          $ch=0;
          echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">Compilation Error Or Submit Failed! Check Internet Connection And Submit Code Again.</textarea><br><br>";
}

if($ch==1)
{
  echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$str</textarea><br><br>";
}




?>
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

</div>
</div>
</div>
</div>



</body>
</html>
