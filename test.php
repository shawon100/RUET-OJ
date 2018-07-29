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
        <title>Set Contest</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

       
        <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/png" href="img/ruet.png">
         <script src="js/vendor/jquery-1.12.0.min.js"></script>
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
        <script src="bootstrap-3.3.7/js/bootstrap.js"></script>
         <script src="js/vendor/moment.min.js"></script>
      

        <link rel="stylesheet" href="css/bootstrap-datetimepicker.css" >
            <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
            <link rel="stylesheet" href="css/bootstrap-datetimepicker-standalone.css">

         
          <script src="js/vendor/bootstrap-datetimepicker.js"></script>


       
    





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
<div class=""><h3 style="text-align:center;">Create New Contest</h3></div>
</div>

<div class="col-sm-1">

</div>

<div class="col-sm-1">
  
</div>

</div>




<div class="row cspace">
<div class="col-sm-8">



<div class="form-group">
<form action="contest.php" name="f2" method="POST">

<label for="ta">Enter Your Contest ID</label>
<input type="text" name="ci" class="form-control"><br><br>
<label for="ta">Enter Your Contest Name</label>
<input type="text" name="cn" class="form-control"><br><br>
<label for="ta">Enter Contest Date</label>
 <div class="input-group date form_datetime2 col-md-5" data-date="2017-06-15T05:25:07Z" data-date-format=" yyyy-mm-dd " data-link-field="dtp_input1">
                    <input type='text' name="cd" class="form-control"  class="form_datetime2" />

                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
          <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div><br><br>
<label for="ta">Enter Contest Start Time</label>
<!--<input type="text" name="ct" class="form-control"><br><br>-->

 <div class="input-group date form_datetime col-md-5" data-date="2017-06-15T05:25:07Z" data-date-format=" yyyy-mm-dd hh:ii " data-link-field="dtp_input1">
                    <input type='text' name="ct" class="form-control"  class="form_datetime" />

                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
          <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div><br><br>

<label for="ta">Enter Contest End Time</label>
<!--<input type="text" name="ce" class="form-control"><br><br>-->


 <div class="input-group date form_datetime1 col-md-5" data-date="2017-06-15T05:25:07Z" data-date-format=" yyyy-mm-dd hh:ii " data-link-field="dtp_input1">
                    <input type='text' name="ce" class="form-control"  class="form_datetime1" />

                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
          <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div><br><br>
<br><br>


<input type="submit" class="btn btn-success" value="Create Contest">


</form>

<script type="text/javascript">

    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
       todayBtn:  1,
        autoclose: 1,
       todayHighlight: 1,
       startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
</script>

<script type="text/javascript">
    $('.form_datetime1').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
      showMeridian: 1
    });
</script>

<script type="text/javascript">
    $('.form_datetime2').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
      showMeridian: 1
    });
</script>



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

<?php

require_once("time.php");

?>
</div>
</div>
</div>
</div>

</body>
</html>