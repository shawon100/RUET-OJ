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

if(isset($_GET['user']))
{
  $data=$_GET['user'];
  $us=$_GET['user'];

  //$query="UPDATE world SET value='$data'";
  //$run=mysqli_query($con,$query);

}

$admin=0;

$mysql="SELECT  status from user WHERE name='$username'";
$snd=mysqli_query($con,$mysql);
$arrow=mysqli_fetch_array($snd);

$st=$arrow['status'];

if($st=="Teacher" || $st=="Problem Setter" || $st=="Developer")
{
   $admin=1;
}


?>


<!DOCTYPE html>
<html>
<head>
  
    
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Profile</title>
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
        <script src="bootstrap-3.3.7/js/bootstrap.min.js"> </script>
        <script src="bootstrap-3.3.7/js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/chart.min.js"></script>
       
        

        

        
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
      <li class="space"><a href="allsubmission.php?name=<?php echo("$username");?>"><i class="fa fa-check-square ispace"></i>Submissions</a></li>
      <li class="lgspace space"><a href="profile.php?user=<?php echo("$username"); ?>"><i class="fa fa-user ispace"></i><?php echo("$username"); ?></a></li>
      <li class="space"><a href="logout.php"><i class="fa fa-power-off ispace"></i>Logout</a></li>
      
    </ul>
    </div>
</nav>
</div>
</div>


<div class="row log">

<?php

if(isset($_GET['user']))
{

   $username=$data;
   
}

$ac="SELECT COUNT(verdict) AS verdict FROM submissions where verdict='Accepted' and sname='$us'";
$wa="SELECT COUNT(verdict) AS verdict FROM submissions where verdict='Wrong Answer' and sname='$us'";
$tle="SELECT COUNT(verdict) AS verdict FROM submissions where verdict='Time Limit Exceed' and sname='$us'";

$s1=mysqli_query($con,$ac);
$s2=mysqli_query($con,$wa);
$s3=mysqli_query($con,$tle);

//$nac=mysqli_fetch_array($s1);
//$nwa=mysqli_fetch_array($s2);
//$ntle=mysqli_fetch_array($s3);

$d=array();
$result=array();



//$data[]=$nwa['verdict'];
//$data[]=$ntle['verdict'];




foreach($s1 as $nac)
{
  $d[]=$nac;
  //$i++;
}


foreach($s2 as $nwa)
{
  $d[]=$nwa;
  //$i++;
}

foreach($s3 as $ntle)
{
  $d[]=$ntle;
  //$i++;
}


json_encode($d);

$dd=$d;


//echo "$username";

?>

<script type="text/javascript">
  
var data= <?php print json_encode($d); ?>;

$(document).ready(function(){
              var verdicts=[];
               var ac=[];
               var wa=[];
               var tle=[];
               var obj;
               

              console.log(data);

              verdicts.push("User's Statistics");
              //verdicts.push("Wrong Answer");
              //verdicts.push("Time Limit Exceed");

              
              
              //console.log(data);
              

               
                  
              ac.push(data[0].verdict);
              wa.push(data[1].verdict);
              tle.push(data[2].verdict);

                   //console.log(data[i].verdict);

               
               
               

               

               var chartdata={
                    labels:verdicts,
                    datasets:[
                      {
                          label:'AC',
                          backgroundColor:'green',
                          borderColor:'green',
                          hoverBackgroundColor:'green',
                          data:ac,
                      },
                      
                      {
                          label:'WA',
                          backgroundColor:'red',
                          borderColor:'red',
                          hoverBackgroundColor:'red',
                          data:wa,
                      },
                      
                      {
                          label:'TLE',
                          backgroundColor:'blue',
                          borderColor:'blue',
                          hoverBackgroundColor:'blue',
                          data:tle,
                      }
                      




                    ]
               };

               var ctx=$('#mycanvas');
               var barGraph=new Chart(ctx,{

                     type:'bar',
                     responsive:true,
                     data:chartdata,
                     options: {
                        scales: {
                          yAxes: [{
                            ticks: {
                              beginAtZero: true,
                              
                              callback: function(value) {if (value % 1 === 0) {return value;}}
                            }
                          }]
                        }
                      }

               });
      
    
});

</script>


<div class=""><h3 style="text-align:center;"><?php  echo"$username's  Profile"; ?></h3></div>

</div>

<?php

$sql="SELECT * FROM user WHERE name='$username'";
$send=mysqli_query($con,$sql);
$row=mysqli_fetch_array($send);


/*$ts="SELECT DISTINCT sname, COUNT(verdict) AS verdict FROM ( SELECT * FROM submission where verdict='Accepted' and sname='$username' GROUP BY pbname, sname)T1 GROUP BY sname";

$sts=mysqli_query($con,$ts);

$solved=mysqli_fetch_array($sts);

$tsolved=$solved['verdict'];

if($tsolved=="")
{
   $tsolved=0;
}
*/

?>


<div class="row cspace">
<div class="col-sm-2">
</div>
<div class="col-sm-6 pbs">

<div class="ym">
 <div class="pc">Information</div>
  
   
   <table class="table">
    <tr class="success"><td>Name : <?php echo("$row[name]") ?></td></tr>
    <tr class="info"><td>Email : <?php echo("$row[email]") ?></td></tr>
    <tr class="danger"><td>Occupation : <?php echo("$row[status]") ?></td></tr>
    <?php

     if($data==$_SESSION['un'])
     {
        echo "<tr class=\"warning\"><td><a href=\"edit.php?name=$username\">Edit Profile</a></td></tr>";
     }

    ?>
    <tr class="info"><td><?php echo("<a href=\"allsubmission.php?name=$username\">Submissions</a>") ?></td></tr>
    
    </table>
  </div>
  <br><br>

  <h3 style="text-align:center;"><?php  echo"$username's Statistics"?></h3><br><br>
  <div id="chart-container">
  <canvas id="mycanvas"></canvas>

  </div><br>

  <!--<div class="alert alert-success"><?php echo "<b>$username's Total Solved Problem = $tsolved</b>" ;?></div><br>--><br><br>
  
  <h3 style="text-align:center;"><?php  echo"$username's Contest History"?></h3><br><br>

  <div class="table-responsive">
    <table class="table">
    <thead>
    <tr>
     <th>ID</th>
     <th>Contest Name</th>
     <th>Date</th>
     <th>User's Activity</th>
    </tr>
    </thead>
    <tbody>

    <?php
    
    require_once("connection.php");

    $his="SELECT DISTINCT cid FROM `submission` WHERE sname='$username'";
    $shis=mysqli_query($con,$his);
    while($chis=mysqli_fetch_array($shis))
    {
        $conid=$chis['cid'];
        $mycon="SELECT * from rapl_oj_contest WHERE id='$conid'";
        $sendcon=mysqli_query($con,$mycon);
        $rhis=mysqli_fetch_array($sendcon);

        echo "<tr><td>$rhis[id]</td><td><a href=\"contestproblem.php?name=$rhis[cname]\">$rhis[cname]</a></td><td>$rhis[date_on]</td><td><a class=\"btn btn-primary btn-xs \" href=\"contestsubmission.php?id=$rhis[id]&show=$username\">Show</a></td></tr>";


    }
      echo "</tbody>
           </table>
           </div><br><br>";



    ?>




    <?php

     if($data==$_SESSION['un']  && $admin==1)
     {
          echo " 
          <div class=\"ym\">
    <div class=\"pc\">Dashboard</div>
  
   
   <ul class=\"nav nav-pills nav-stacked\">
    <li role=\"presentation\" class=\"active\"><a href=\"setcontest.php\">Create Contest</a></li>
    <li role=\"presentation\"><a href=\"setcontestproblem.php\">Create Contest Problem</a></li>
    <li role=\"presentation\"><a href=\"setproblem.php\">Create Archive Problem</a></li>
    <li role=\"presentation\"><a href=\"allsubmission.php?name=$username\">My Submission</a></li>
    <li role=\"presentation\"><a href=\"announcement.php\">Announcement</a></li>
     <li role=\"presentation\"><a href=\"createadmin.php\">Create Admin</a></li>
  </ul></div>";



          
     }
   ?>

<!--<div class="ym">
 <div class="pc">Dashboard</div>
  
   
   <ul class="nav nav-pills nav-stacked">
    <li role="presentation" class="active"><a href="setcontest.php">Create Contest</a></li>
    <li role="presentation"><a href="setcontestproblem.php">Create Contest Problem</a></li>
    <li role="presentation"><a href="setproblem.php">Create Archive Problem</a></li>
    <li role="presentation"><a href="allsubmission.php?name=<?php ; ?>">My Submission</a></li>
  </ul>
  
 <ul class="nav nav-pills nav-stacked ">
    <li class="active"><a data-toggle="pill" href="#home">Profile</a></li>
    <li><a data-toggle="pill" href="#menu1">Submission</a></li>
    <li><a data-toggle="pill" href="#menu2">Statistics</a></li>
  
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <?php

       //echo"<br><br><br>";
       //echo "Name: $data<br>";

      ?>
      
    </div>
    <div id="menu1" class="tab-pane fade">
     <?php
        //echo"<br><br><br>";
       //echo "Name: $user<br>";
       ?>
    </div>
    <div id="menu2" class="tab-pane fade">
       <?php
        //echo"<br><br><br>";
       //echo "Name: $user<br>";
       ?>
    </div>
    
  </div>
</div>-->






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
