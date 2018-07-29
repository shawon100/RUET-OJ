<?php

session_start();
require_once("config.php");

$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION["un"]))
{
	header("Location:login.php");
}

if(isset($_SESSION['un']))
{
	$username=$_SESSION['un'];
}

$mysql="SELECT  status from user WHERE name='$username'";
$snd=mysqli_query($con,$mysql);
$arrow=mysqli_fetch_array($snd);

$st=$arrow['status'];

$access=0;

if($st=="Teacher" || $st=="Problem Setter" || $st=="Developer")
{
   $access=1;
}
else
{
    header("Location:home.php");
}



?>

<!DOCTYPE html>
<html>
<head>
  
    
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Set Problem</title>
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
<div class="col-sm-10">
<div class=""><h3 style="text-align:center;">Set Problem</h3></div>
</div>

<div class="col-sm-1">

</div>

<div class="col-sm-1">
  
</div>

</div>




<div class="row cspace">
<div class="col-sm-8">
<div class="form-group">
<form action="contestproblem.php" name="f2" method="POST">

<label for="ta">Enter Your Contest ID</label>
<input type="text" name="ci" class="form-control"><br><br>
<label for="ta">Enter Your Contest Name</label>
<input type="text" name="cn" class="form-control"><br><br>
<label for="ta">Enter Problem Name</label>
<input type="text" name="pb" class="form-control"><br><br>
<label for="in">Enter Problem Description</label>
<textarea name="c1" class="form-control" rows="30" cols="80"></textarea><br><br>
<label for="ta">Enter Problem Author</label>
<input type="text" name="c2" class="form-control"><br><br>
<label for="ta">Enter Time Limit</label>
<input type="text" name="tll" title="Only float is allowed (Ex:3.00)" placeholder="1.00" class="form-control"><br><br>
<b>Enter Test Cases</b><br>
<textarea class="form-control" name="c3" rows="30" cols="80"></textarea><br><br>
<b>Enter Output Of Test Cases</b><br>
<textarea class="form-control" name="c4" rows="30" cols="80"></textarea><br><br>
<input type="submit" class="btn btn-success" value="Create Problem">




</form>

<?php

if(isset($_GET['fail']))
{

?>

 <script type="text/javascript">alert("You Are Not Owner Of This Contest . Only Owner Can Add Problems");</script>


  <?php

   }

  ?>



</div>
</div>

<div class="col-sm-4">

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

</div>
</div>
</div>
</div>

</body>
</html>
















