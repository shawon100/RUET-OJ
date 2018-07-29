<?php

session_start();

require_once("config.php");
require_once("connection.php");

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
        <title>Standings</title>
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
      <li class="space"><a href=""><i class="fa fa-check-square ispace"></i>Debug</a></li>
      <li class="lgspace space"><a href="profile.php?user=<?php echo("$username"); ?>"><i class="fa fa-user ispace"></i><?php echo("$username"); ?></a></li>
      <li class="space"><a href="logout.php"><i class="fa fa-power-off ispace"></i>Logout</a></li>
    </ul>
    </div>
</nav>
</div>
</div>

<?php

if(isset($_GET['id']))
{
    $conid=$_GET['id'];
    $mycon="SELECT * from rapl_oj_contest WHERE id='$conid'";
    $sendcon=mysqli_query($con,$mycon);
    $rhis=mysqli_fetch_array($sendcon);


}


?>

<div class="row log">

<div class=""><h3 style="text-align:center;">Standings</h3></div><br>
<h3 style="text-align:center;"><?php echo "<a class=\"btn btn-primary\" href=\"contestproblem.php?name=$rhis[cname]\">$rhis[cname]</a>"; ?></h3>
</div>




<div class="row cspace">
<div class="col-sm-1">
</div>
<div class="col-sm-9">
  <div class="table-responsive">
    <table class="table">
    <thead>
    <tr>
     <th>Rank</th>
     <th>Name</th>
     <th>Total Solved</th>
     <th>Total Points</th>
     <th>Submission</th>
    </tr>
    </thead>
    <tbody>



<?php


if(isset($_GET['id']))
{
  $conid=$_GET['id'];
  

/*$sql="SELECT sname,SUM(status) AS Solved FROM ( SELECT * FROM submission WHERE cid='$conid' AND status='1'  GROUP BY  pbname,sname )T1 GROUP BY sname

UNION ALL

SELECT * FROM  (SELECT sname, SUM(status) As Solved  FROM submission WHERE cid='$conid' GROUP BY  sname)T2  HAVING Solved='0'
ORDER BY `Solved`  DESC ";*/

$sql="SELECT sname, SUM(status) As Solved, SUM(point) As Points FROM submission Where cid='$conid' GROUP BY sname ORDER BY Solved DESC , Points DESC";

$send=mysqli_query($con,$sql);
$i=0;
while($row=mysqli_fetch_array($send))
{
  $i++;
  echo "<tr><td>$i</td><td><a href=\"profile.php?user=$row[sname]\">$row[sname]</a></td><td>$row[Solved]</td><td>$row[Points]</td><td><a href=\"contestsubmission.php?id=$conid&show=$row[sname]\"><div class=\"btn btn-primary btn-xs\">Show</td></tr>";
}

  echo "</tbody>
</table>
</div><br><br><br><br><br>";

 

}
?>
</div>

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












