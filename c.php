
<?php
session_start();

require_once("config.php");

$_SESSION['url'] = $_SERVER['REQUEST_URI'];

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
        <link rel="icon" type="image/png" href="img/ruet.png">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="js/vendor/jquery-1.12.0.min.js"></script>
        <script src="bootstrap-3.3.7/js/bootstrap.min.js" </script>
        <script src="bootstrap-3.3.7/js/bootstrap.js" </script>







</head>
<body>
<div class="main">
 <div class="row">
  <div class="col-sm-12">
  <nav class="shadow navbar navbar-inverse navbar-fixed-top nbar">
    <div class="navbar-header">
      <a class="navbar-brand lspace" href="home.php">RUET OJ</a>
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
    </div>
    <div class="collapse navbar-collapse navbar-menubuilder">
    <ul class="nav navbar-nav">
      <li class="space"><a href="compiler.php"><i class="fa fa-code ispace"></i>Compiler</a></li>
      <li class="space"><a href="archive.php"><i class="fa fa-archive ispace"></i>Problem Archive</a></li>
      <li class="space"><a href="contest.php"><i class="fa fa-cogs ispace"></i>Contests</a></li>
      <li class="space"><a href="#"><i class="fa fa-check-square ispace"></i>Debug</a></li>
      <li class="lgspace space"><a href="profile.php?user=<?php echo("$username"); ?>"><i class="fa fa-user ispace"></i><?php echo("$username"); ?></a></li>
      <li class="space"><a href="logout.php"><i class="fa fa-power-off ispace"></i>Logout</a></li>
      
    </ul>
    </div>
</nav>
</div>
</div>


<div class="row log">
<div class="col-sm-2">
</div>

<div class="col-sm-7">
<div class=""><h3 style="text-align:center;">Code Compiler</h3></div>
</div>

<div class="col-sm-3">
  
</div>

</div>

<div class="row cspace">
<div class="col-sm-8">


<?php

if($_POST['code'])
{


$lang=$_POST['language'];
$source=$_POST['code'];
//$input=$_POST['in'];
$pb=$_POST['pbn'];
$pid=$_POST['id'];
$us=$_SESSION['un'];


$isql="SELECT * FROM archieve WHERE id='$pid'";
$si=mysqli_query($con,$isql);
$r4=mysqli_fetch_array($si);

$limit=$r4['tlimit'];

//$input=$r4['tc'];

    $CC="gcc";
	$out="timeout 5s ./a.out";
	$code=$_POST["code"];
	$input=$r4['tc'];
	$filename_code="main.c";
	$filename_in="input.txt";
	$filename_error="error.txt";
	$executable="a.out";
	$command=$CC." -lm ".$filename_code;	
	$command_error=$command." 2>".$filename_error;
	$check=0;
	$tle=0;
	$ce=0;



	//if(trim($code)=="")
	//die("The code area is empty");
	
	$file_code=fopen($filename_code,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
	$file_in=fopen($filename_in,"w+");
	fwrite($file_in,$input);
	fclose($file_in);
	exec("chmod 777 $executable"); 
	exec("chmod 777 $filename_error");	

	shell_exec($command_error);
	$error=file_get_contents($filename_error);


    $sql="SELECT output FROM archieve WHERE id='$pid'";

    $sq=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($sq);

    $executionStartTime = microtime(true);
	if(trim($error)=="")
	{
		if(trim($input)=="")
		{
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$filename_in;
			$output=shell_exec($out);
		}


		
		//echo "<pre>$output</pre>";
        //echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
		         echo "<div class=\"row\"><div class=\"col-sm-4\"></div><div class=\"col-sm-6\"><div class=\"alert alert-success\"><strong>Successfully Compiled!</strong> Click Below Submit Button To Submit.</div></div><div class=\"col-sm-2\"></div></div><br>";
	}
	else if(!strpos($error,"error"))
	{
		echo "<pre>$error</pre>";
		if(trim($input)=="")
		{
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$filename_in;
			$output=shell_exec($out);
		}



		//echo "<pre>$output</pre>";
                //echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
				 echo "<div class=\"row\"><div class=\"col-sm-4\"></div><div class=\"col-sm-6\"><div class=\"alert alert-success\"><strong>Successfully Compiled!</strong> Click Below Submit Button To Submit.</div></div><div class=\"col-sm-2\"></div></div><br>";
	}
	else
	{
		echo "<pre>$error</pre>";
		$check=1;
		$ce=1;
			echo "<div class=\"row\"><div class=\"col-sm-4\"></div><div class=\"col-sm-6\"><div class=\"alert alert-danger\"><strong>Compilation Error Or Submit Failed!</strong> Back To Problem Description And Submit Code Again.</div></div><div class=\"col-sm-2\"></div></div><br>";
	}
	$executionEndTime = microtime(true);
	$seconds = $executionEndTime - $executionStartTime;
	$seconds = sprintf('%0.2f', $seconds);
	//echo "<pre>Compiled And Executed In: $seconds s</pre>";
    
    

	if($seconds>$limit)
	{
		$fr="lt";
	}
	else if($ce==1)
	{
		 $fr="e";
	}
	else if(trim($output)=="")
	{
          $fr="rte";
	}

	exec("rm $filename_code");
	exec("rm *.o");
	exec("rm *.txt");
	exec("rm $executable");

	if($check==0 || $check==1)
	{

        $nsql="INSERT into codes VALUES('$us','$source',NULL)";
		$usql="UPDATE archieve SET uoutput='$output' WHERE id='$pid'";
		$csql="SELECT uoutput FROM archieve WHERE id='$pid'";
		$q3="SELECT id FROM codes ORDER BY id DESC ";
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

	


	}
	//echo "<div class=\"row\"><div class=\"col-sm-5\"></div><div class=\"col-sm-5\"><form action=\"allsubmission.php\" method=\"POST\"><input type=\"hidden\" name=\"pb\" value=\"$pb\"><input type=\"hidden\" name=\"id\" value=\"$pid\"><input type=\"hidden\" name=\"mid\" value=\"$nid\"><input type=\"hidden\" name=\"vd\" value=\"$fr\"><input type=\"hidden\" name=\"il\" value=\"$tle\"><textarea style=\"display:none\" name=\"result\" rows=\"10\" cols=\"10\">$output</textarea><input class=\"btn btn-success tm\" type=\"submit\" value=\"Submit Code\"> </div><div class=\"col-sm-2\"></div></div>";

  echo "<center><div class=\"row\"><form action=\"allsubmission.php\" method=\"POST\"><input type=\"hidden\" name=\"pb\" value=\"$pb\"><input type=\"hidden\" name=\"id\" value=\"$pid\"><input type=\"hidden\" name=\"mid\" value=\"$nid\"><input type=\"hidden\" name=\"vd\" value=\"$fr\"><input type=\"hidden\" name=\"il\" value=\"$seconds\"><textarea style=\"display:none\" name=\"result\" rows=\"10\" cols=\"10\">$output</textarea><input class=\"btn btn-success tm\" type=\"submit\" value=\"Submit Code\"></div></center>";


}

else if($_POST['src'])
{


    require_once("connection.php");
    
	$lang=$_POST['language'];
	$source=$_POST['src'];
	$pb=$_POST['pbn'];
	$pid=$_POST['id'];
	$us=$_SESSION['un'];
	$check=0;
	$tle=0;
	$ce=0;

	$isql="SELECT * FROM element WHERE pbid='$pid'";
	$si=mysqli_query($con,$isql);
	$r4=mysqli_fetch_array($si);

	$limit=$r4['tlimit'];





	$CC="gcc";
	$out="timeout 5s ./a.out";
	$code=$_POST["src"];
	$input=$r4['tc'];
	$filename_code="main.c";
	$filename_in="input.txt";
	$filename_error="error.txt";
	$executable="a.out";
	$command=$CC." -lm ".$filename_code;	
	$command_error=$command." 2>".$filename_error;

	

	//if(trim($code)=="")
	//die("The code area is empty");
	
	$file_code=fopen($filename_code,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
	$file_in=fopen($filename_in,"w+");
	fwrite($file_in,$input);
	fclose($file_in);
	exec("chmod 777 $executable"); 
	exec("chmod 777 $filename_error");	

	shell_exec($command_error);
	$error=file_get_contents($filename_error);



	$sql="SELECT output FROM element WHERE pbid='$pid'";
    $sq=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($sq);


   $executionStartTime = microtime(true);

	if(trim($error)=="")
	{
		if(trim($input)=="")
		{
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$filename_in;
			$output=shell_exec($out);
		}
		//echo "<pre>$output</pre>";
        //echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
         echo "<div class=\"row\"><div class=\"col-sm-5\"></div><div class=\"col-sm-5\"><div class=\"alert alert-success\"><strong>Successfully Compiled!</strong> Click  Submit Button To Submit.</div></div><div class=\"col-sm-2\"></div></div><br>";
	}
	else if(!strpos($error,"error"))
	{
		echo "<pre>$error</pre>";
		if(trim($input)=="")
		{
			$output=shell_exec($out);
		}
		else
		{
			$out=$out." < ".$filename_in;
			$output=shell_exec($out);
		}
		//echo "<pre>$output</pre>";
                //echo "<textarea id='div' class=\"form-control\" name=\"output\" rows=\"10\" cols=\"50\">$output</textarea><br><br>";
		 echo "<div class=\"row\"><div class=\"col-sm-5\"></div><div class=\"col-sm-5\"><div class=\"alert alert-success\"><strong>Successfully Compiled!</strong> Click  Submit Button To Submit.</div></div><div class=\"col-sm-2\"></div></div><br>";
	}
	else
	{
		echo "<pre>$error</pre>";
		$check=1;
		$ce=1;

		echo "<div class=\"row\"><div class=\"col-sm-5\"></div><div class=\"col-sm-5\"><div class=\"alert alert-danger\"><strong>Compilation Error Or Submit Failed!</strong> Back To Problem Description And Submit Code Again.</div></div><div class=\"col-sm-2\"></div></div><br>";
	}
	$executionEndTime = microtime(true);
	$seconds = $executionEndTime - $executionStartTime;
	$seconds = sprintf('%0.2f', $seconds);
	//echo "<pre>Compiled And Executed In: $seconds s</pre>";
	if($seconds>$limit)
	{
		$fr="lt";
	}
	else if($ce==1)
	{
		 $fr="e";
	}
	else if(trim($output)=="")
	{
          $fr="rte";
	}
	exec("rm $filename_code");
	exec("rm *.o");
	exec("rm *.txt");
	exec("rm $executable");




    if($check==0 || $check==1)
    {

            $nsql="INSERT into code VALUES('$us','$code',NULL)";
			$usql="UPDATE element SET uoutput='$output' WHERE pbid='$pid'";
			$csql="SELECT uoutput FROM element WHERE pbid='$pid'";
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




    }

    //echo "<div class=\"row\"><div class=\"col-sm-5\"></div><div class=\"col-sm-5\"><form action=\"contestsubmission.php\" method=\"POST\"><input type=\"hidden\" name=\"pb\" value=\"$pb\"><input type=\"hidden\" name=\"id\" value=\"$pid\"><input type=\"hidden\" name=\"mid\" value=\"$nid\"><input type=\"hidden\" name=\"il\" value=\"$tle\"><textarea style=\"display:none\" name=\"result\" rows=\"10\" cols=\"10\">$output</textarea><input class=\"btn btn-success tm\" type=\"submit\" value=\"Submit Code\"> </div><div class=\"col-sm-2\"></div></div>";

  echo "<div class=\"row\"><div class=\"col-sm-4\"></div><div class=\"col-sm-5\"><form action=\"contestsubmission.php\" method=\"POST\"><input type=\"hidden\" name=\"pb\" value=\"$pb\"><input type=\"hidden\" name=\"id\" value=\"$pid\"><input type=\"hidden\" name=\"mid\" value=\"$nid\"><input type=\"hidden\" name=\"vd\" value=\"$fr\"><input type=\"hidden\" name=\"il\" value=\"$seconds\"><textarea style=\"display:none\" name=\"result\" rows=\"10\" cols=\"10\">$output</textarea><input class=\"btn btn-success tm\" type=\"submit\" value=\"Submit Code\"> </div><div class=\"col-sm-3\"></div></div>";
}
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
