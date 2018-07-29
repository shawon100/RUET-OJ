<?php

session_start();

$_SESSION['url'] = $_SERVER['REQUEST_URI'];

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
        <title>Description</title>
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
      <li class="space"><a href="allsubmission.php"><i class="fa fa-check-square ispace"></i>Submission</a></li>
      <li class="lgspace space"><a href="profile.php?user=<?php echo("$username"); ?>"><i class="fa fa-user ispace"></i><?php echo("$username"); ?></a></li>
      <li class="space"><a href="logout.php"><i class="fa fa-power-off ispace"></i>Logout</a></li>
    </ul>
    </div>
</nav>
</div>
</div>


<?php

require_once("config.php");

if($_GET['id'])
{
  $problemid=$_GET['id'];
}

if(isset($_GET['name']))
{
	$problem=$_GET['name'];
	$sql="SELECT * FROM archieve WHERE pbname='$problem'";
}
else
{
  $sql="SELECT * FROM archieve WHERE id='$problemid'";
}



$sq=mysqli_query($con,$sql);

$row=mysqli_fetch_array($sq);



echo "
<div class=\"row log\">
<div class=\"col-sm-10\">
<div class=\"\"><h3 style=\"text-align:center;\">$row[pbname]</h3></div>
</div>

<div class=\"col-sm-1\">

</div>

<div class=\"col-sm-1\">
  
</div>

</div>";


echo "

<div class=\"row cspace\">
<div class=\"col-sm-10\">
<p>Time Limit: $row[tlimit] Seconds</p><br><br>
<b>Problem Description</b><br><br><textarea class=\"form-control\" rows=\"30\" cols=\"100\" readonly>$row[pbdes]</textarea><br>";

echo "<b>Problem Setter : <a href=\"profile.php?user=$row[pbauthor]\">$row[pbauthor]</a></b><br><br>";

//echo "<form action=\"submit.php\" method=\"POST\"><textarea style=\"display:none\" name=\"tcase\">$row[tc]</textarea><br><br><textarea style=\"display:none\" name=\"out\">$row[output]</textarea><br><br></form>";


echo "<a class=\"btn btn-success\" href=\"submit.php?id=$row[id]\">Submit Your Code</a></div>";





?>

<div class="col-sm-2">

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


<div class="">

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
