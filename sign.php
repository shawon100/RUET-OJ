



<!DOCTYPE html>
<html>
<head>
	
    
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Sign Up</title>
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
      <li class="lgspace space"><a href="login.php"><i class="fa fa-sign-in ispace"></i>Login</a></li>
      <li class="space"><a href="sign.php"><i class="fa fa-chevron-circle-up ispace"></i>Sign Up</a></li>
      
    </ul>
    </div>
</nav>
</div>
</div><br><br>
<div class="row mu">
<div class="col-sm-1">
</div>
<div class="col-sm-9">
<center>
<div class="form-group log">
<div class="xmm">
<h2 style=""><u>Sign Up</u></h2><br><br>
<form action="action.php" name="f1" method="POST">

<label for="email">Email</label>
<input type="email" name="email" class="form-control" placeholder="Enter Email" required><br>
<label for="username">Username</label>
<input type="text" name="uname" class="form-control" placeholder="Enter Username" required><br>
<label for="password">Password</label>
<input type="password" class="form-control"  name="password" placeholder="Enter Password" required><br>

<button type="submit" class="btn btn-success">Sign Up</button><br><br>
	

</form>
<?php
if(isset($_GET['value']))
{
   
   echo "<div class=\"alert alert-danger\">
  <strong>Sign up Failed!</strong>  Username already exists!!
   </div><br>";
    
}
?>
</div>
</div>
</center>
</div>

<div class="col-sm-2">

</div>
</div>
</div>
<div class="sign">
<div class="container-fluid well foot">
<div class="row">



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


