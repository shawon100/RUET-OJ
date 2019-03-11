<?php

ob_start();
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

if(isset($_GET['name']))
{
      
   $coname=$_GET['name'];

}


?>


<?php

 require_once("connection.php");

 if(isset($_GET['name']))
 {

   $fowner="SELECT  owner from rapl_oj_contest where cname='$coname'";
   $sendit=mysqli_query($con,$fowner);
   $frow=mysqli_fetch_array($sendit);
   $owner=$frow['owner'];

   if($username==$owner)
   {
        $access=1;
   }
   else if($st=="Teacher" || $st=="Developer")
   {   
        $access=1;
   }
   else
   {
       $access=0;
   }
 }

?>

<!DOCTYPE html>
<html>
<head>
  
    
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Contest Problems</title>
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

      <script>
      // Set the date we're counting down to

      function call(d,val,st){

      //console.log(d);
      //console.log(val);
      //console.log(st);
      var countDownDate = new Date(d).getTime();
      var start =new Date(st).getTime();

      //console.log(start);

      var result;

      // Update the count down every 1 second
      var x = setInterval(function() {

          // Get todays date and time
          var now = new Date().getTime();
          
          // Find the distance between now an the count down date
          
          
         
         

          if(start>now)
          {

             var distance = start - now;

             console.log(distance);

              // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);


            // Output the result in an element with id="demo"
            var result=days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

            //console.log(result);

             document.getElementById(val).innerHTML = "Contest Countdown : "+ days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
          }
          else if(countDownDate>=now)
          {
              var distance = countDownDate - now;

              // Time calculations for days, hours, minutes and seconds
              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);

               
              // Output the result in an element with id="demo"
              var result=days + "d " + hours + "h "
              + minutes + "m " + seconds + "s ";

            //console.log(result);
              document.getElementById(val).innerHTML = "Running : "+ days + "d " + hours + "h "
             + minutes + "m " + seconds + "s ";
              document.getElementById("demo").innerHTML = "Running : "+ days + "d " + hours + "h "
             + minutes + "m " + seconds + "s ";
          }
          
          // If the count down is over, write some text 
          else if (now>countDownDate) {
              clearInterval(x);
              document.getElementById(val).innerHTML = "Status : Finished";
              document.getElementById("demo").innerHTML = "Finished";
          }


          
      }, 1000);

        return x;
      }


      </script>






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
<div class="container-fluid log">

<div class="alert alert-info">
  <button id="an" class="btn btn-success">
   <script type="text/javascript">
        
        $("#an").click(function() {
           $('html,body').animate({
        scrollTop: $("#fn").offset().top},
        'slow');
});
</script>
</button>
</div>
<div class="row">
<div class="col-sm-8">
<div class=""><h3 style="text-align:center;">Contest Problems</h3></div><br><br>

<h2><div id="tc"></div></h2>

<div class="table-responsive">
    <table class="table">
    <thead>
    <tr>
     <th>ID</th>
     <th>Problem Name</th>
     <th>Status</th>
     <th>Accepted/Submission</th>
     <th>Problem Setter</th>
    </tr>
    </thead>
    <tbody>



<?php
require_once("connection.php");

date_default_timezone_set("Asia/Dhaka");


if(isset($_POST['up']))
{
   

    $contest=$_POST['cnn'];
    $cid=$_POST['ccid'];
    $pbid=$_POST['ci'];
    $pn=$_POST['pb'];
    $des=$_POST['c1'];
    $au=$_POST['c2'];
    $tc=$_POST['c3'];
    $out=$_POST['c4'];
    $ptl=$_POST['tll'];


    $update="UPDATE element SET pbname='$pn',pbdes='$des',pbauthor='$au',tc='$tc',output='$out',tlimit=$ptl WHERE pbid=$pbid";
    $supdate=mysqli_query($con,$update);

    if($supdate)
    {
       echo "<script>alert(\"Updated Successfully\");</script>";

    }
    else
    {
       echo "<script>alert(\"Failed\");</script>";

    }
    
    $q3="SELECT * FROM element WHERE cname='$contest'";

    $sq3=mysqli_query($con,$q3);


while($row=mysqli_fetch_array($sq3))
{
   //echo("<a href=\"details.php?id=$row[pbid]\"><div class=\"pb\">$row[pbname]</div></a><br>");
  $problem_name=$row['pbname'];

  $number="SELECT verdict from submission WHERE pbname='$row[pbname]' and sname='$username' and verdict='Accepted' and cid='$cid'";
  $snumber=mysqli_query($con,$number);
  $tsol=mysqli_num_rows($snumber);

  $acn="SELECT COUNT(verdict) AS verdict from submission WHERE verdict='Accepted' AND pbname='$row[pbname]' AND cid='$cid' GROUP BY pbname";
  $sacn=mysqli_query($con,$acn);
  $sol=mysqli_fetch_array($sacn);


  $tsub="SELECT COUNT(verdict) as sub from submission WHERE pbname='$row[pbname]' AND cid='$cid' GROUP BY pbname";
  $stsub=mysqli_query($con,$tsub);
  $ntsub=mysqli_fetch_array($stsub);


  if($tsol>0)
  {
     $ver="Solved";
         echo "

   
  <tr><td>$row[pbid]</td><td><a href=\"details.php?id=$row[pbid]\"><div class=\"\">$row[pbname]</div></a></td><td><div class=\"btn btn-success btn-xs\">$ver</div></td><td><progress id=\"myProgress\" value=\"$sol[verdict]\" max=\"$ntsub[sub]\"></progress> $sol[verdict]/$ntsub[sub]</td><td>$row[pbauthor]</td></tr>";

  }
  else
  {
         $ver="Unsolved";
         echo "

   
  <tr><td>$row[pbid]</td><td><a href=\"details.php?id=$row[pbid]\"><div class=\"\">$row[pbname]</div></a></td><td><div class=\"btn btn-danger btn-xs\">$ver</div></td><td><progress id=\"myProgress\" value=\"$sol[verdict]\" max=\"$ntsub[sub]\"></progress> $sol[verdict]/$ntsub[sub]</td><td>$row[pbauthor]</td></tr>";
  }
}

echo "</tbody>
</table>
</div><br><br>";


}


if(isset($_POST['del']))
{
    $contest=$_POST['cnn'];
    $cid=$_POST['ccid'];
    $pbid=$_POST['ci'];
    $pn=$_POST['pb'];
    $des=$_POST['c1'];
    $au=$_POST['c2'];
    $tc=$_POST['c3'];
    $out=$_POST['c4'];
    $ptl=$_POST['tll'];


    $delete="DELETE FROM element WHERE pbid=$pbid";
    $sdelete=mysqli_query($con,$delete);

    if($sdelete)
    {
       echo "<script>alert(\"Deleted Successfully\");</script>";
    }

     $q3="SELECT * FROM element WHERE cname='$contest'";

    $sq3=mysqli_query($con,$q3);


while($row=mysqli_fetch_array($sq3))
{
   //echo("<a href=\"details.php?id=$row[pbid]\"><div class=\"pb\">$row[pbname]</div></a><br>");
  $problem_name=$row['pbname'];

  $number="SELECT verdict from submission WHERE pbname='$row[pbname]' and sname='$username' and verdict='Accepted' and cid='$cid'";
  $snumber=mysqli_query($con,$number);
  $tsol=mysqli_num_rows($snumber);

  $acn="SELECT COUNT(verdict) AS verdict from submission WHERE verdict='Accepted' AND pbname='$row[pbname]' AND cid='$cid' GROUP BY pbname";
  $sacn=mysqli_query($con,$acn);
  $sol=mysqli_fetch_array($sacn);


  $tsub="SELECT COUNT(verdict) as sub from submission WHERE pbname='$row[pbname]' AND cid='$cid' GROUP BY pbname";
  $stsub=mysqli_query($con,$tsub);
  $ntsub=mysqli_fetch_array($stsub);


  if($tsol>0)
  {
     $ver="Solved";
         echo "

   
  <tr><td>$row[pbid]</td><td><a href=\"details.php?id=$row[pbid]\"><div class=\"\">$row[pbname]</div></a></td><td><div class=\"btn btn-success btn-xs\">$ver</div></td><td><progress id=\"myProgress\" value=\"$sol[verdict]\" max=\"$ntsub[sub]\"></progress> $sol[verdict]/$ntsub[sub]</td><td>$row[pbauthor]</td></tr>";

  }
  else
  {
         $ver="Unsolved";
         echo "

   
  <tr><td>$row[pbid]</td><td><a href=\"details.php?id=$row[pbid]\"><div class=\"\">$row[pbname]</div></a></td><td><div class=\"btn btn-danger btn-xs\">$ver</div></td><td><progress id=\"myProgress\" value=\"$sol[verdict]\" max=\"$ntsub[sub]\"></progress> $sol[verdict]/$ntsub[sub]</td><td>$row[pbauthor]</td></tr>";
  }
}

echo "</tbody>
</table>
</div><br><br>";


}




if(isset($_POST['cn']))
{

$contest=$_POST['cn'];
$cid=$_POST['ci'];
$pn=$_POST['pb'];
$des=$_POST['c1'];
$au=$_POST['c2'];
$tc=$_POST['c3'];
$out=$_POST['c4'];
$ptl=$_POST['tll'];

   $fowner="SELECT  owner from rapl_oj_contest where id='$cid'";
   $sendit=mysqli_query($con,$fowner);
   $frow=mysqli_fetch_array($sendit);
   $owner=$frow['owner'];

   if($username==$owner)
   {
        $access=1;
   }
   else if($st=="Teacher" || $st=="Developer")
   {   
        $access=1;
   }
   else
   {
       $access=0;
   }



if($access==1)
{

$q2="INSERT into element  VALUES('$cid','$contest','$pn','$des','$au','$tc','$out','',NULL,'$ptl')";
$q3="SELECT * FROM element WHERE cname='$contest'";

$sq2=mysqli_query($con,$q2);
$sq3=mysqli_query($con,$q3);


while($row=mysqli_fetch_array($sq3))
{
   //echo("<a href=\"details.php?id=$row[pbid]\"><div class=\"pb\">$row[pbname]</div></a><br>");
  $problem_name=$row['pbname'];

  $number="SELECT verdict from submission WHERE pbname='$row[pbname]' and sname='$username' and verdict='Accepted' and cid='$cid'";
  $snumber=mysqli_query($con,$number);
  $tsol=mysqli_num_rows($snumber);

  $acn="SELECT COUNT(verdict) AS verdict from submission WHERE verdict='Accepted' AND pbname='$row[pbname]' AND cid='$cid' GROUP BY pbname";
  $sacn=mysqli_query($con,$acn);
  $sol=mysqli_fetch_array($sacn);


  $tsub="SELECT COUNT(verdict) as sub from submission WHERE pbname='$row[pbname]' AND cid='$cid' GROUP BY pbname";
  $stsub=mysqli_query($con,$tsub);
  $ntsub=mysqli_fetch_array($stsub);


  if($tsol>0)
  {
     $ver="Solved";
         echo "

   
  <tr><td>$row[pbid]</td><td><a href=\"details.php?id=$row[pbid]\"><div class=\"\">$row[pbname]</div></a></td><td><div class=\"btn btn-success btn-xs\">$ver</div></td><td><progress id=\"myProgress\" value=\"$sol[verdict]\" max=\"$ntsub[sub]\"></progress> $sol[verdict]/$ntsub[sub]</td><td>$row[pbauthor]</td></tr>";

  }
  else
  {
         $ver="Unsolved";
         echo "

   
  <tr><td>$row[pbid]</td><td><a href=\"details.php?id=$row[pbid]\"><div class=\"\">$row[pbname]</div></a></td><td><div class=\"btn btn-danger btn-xs\">$ver</div></td><td><progress id=\"myProgress\" value=\"$sol[verdict]\" max=\"$ntsub[sub]\"></progress> $sol[verdict]/$ntsub[sub]</td><td>$row[pbauthor]</td></tr>";
  }
}

echo "</tbody>
</table>
</div><br><br>";

}

else
{
    header("Location:setcontestproblem.php?fail=1");
}



}
if(isset($_GET['name']))
{
  $n=$_GET['name'];
  $q3="SELECT * FROM element WHERE cname='$n'";
  $fcontest="SELECT id from rapl_oj_contest where cname='$n'";
  $sf=mysqli_query($con,$fcontest);
  $myrow=mysqli_fetch_array($sf);

  $r=mysqli_query($con,$q3);

   while($row=mysqli_fetch_array($r))
   {
      //echo("<a href=\"details.php?id=$row[pbid]\"><div class=\"pb\">$row[pbname]</div></a><br>");
      $problem_name=$row['pbname'];
      $cid=$myrow['id'];


      $number="SELECT verdict from submission WHERE pbname='$row[pbname]' and sname='$username' and verdict='Accepted' AND cid='$cid'";
      $snumber=mysqli_query($con,$number);
      $tsol=mysqli_num_rows($snumber);

      $acn="SELECT COUNT(verdict) AS verdict from submission WHERE verdict='Accepted' AND pbname='$row[pbname]' AND cid='$cid' GROUP BY pbname";
      $sacn=mysqli_query($con,$acn);
      $sol=mysqli_fetch_array($sacn);


      $tsub="SELECT COUNT(verdict) as sub from submission WHERE pbname='$row[pbname]' AND cid='$cid' GROUP BY pbname";
      $stsub=mysqli_query($con,$tsub);
      $ntsub=mysqli_fetch_array($stsub);


      if($tsol>0)
      {
         $ver="Solved";
             echo "

       
      <tr><td>$row[pbid]</td><td><a href=\"details.php?id=$row[pbid]\"><div class=\"\">$row[pbname]</div></a></td><td><div class=\"btn btn-success btn-xs\">$ver</div></td><td><progress id=\"myProgress\" value=\"$sol[verdict]\" max=\"$ntsub[sub]\"></progress> $sol[verdict]/$ntsub[sub]</td><td>$row[pbauthor]</td></tr>";

      }
      else
      {
             $ver="Unsolved";
             echo "

       
      <tr><td>$row[pbid]</td><td><a href=\"details.php?id=$row[pbid]\"><div class=\"\">$row[pbname]</div></a></td><td><div class=\"btn btn-danger btn-xs\">$ver</div></td><td><progress id=\"myProgress\" value=\"$sol[verdict]\" max=\"$ntsub[sub]\"></progress> $sol[verdict]/$ntsub[sub]</td><td>$row[pbauthor]</td></tr>";
      }
      }

      echo "</tbody>
</table>
</div><br><br>";

echo "<h3 style=\"text-align:center;\">Announcement</h3><br>";
   $query="SELECT des from announcement where cname='$n'";
   $send=mysqli_query($con,$query);
   $nrow=mysqli_num_rows($send);
   
   if($nrow>0)
   {


     while($arow=mysqli_fetch_array($send))
     {
         echo "<div id=\"fn\" class=\"alert alert-info\">$arow[des]</div><br>";
     }

         echo "<script>
    document.getElementById(\"an\").innerHTML = \"$nrow New Announcement</a>\";
    </script>";

   }
   else
   {
      echo "<div id=\"fn\" class=\"alert alert-info\">No Announcement Yet</div><br>";
      echo "<script>
    document.getElementById(\"an\").innerHTML = \"No New Announcement\";
    </script>";

   } 

}





/*require_once("connection.php");

$q6="SELECT table_name FROM information_schema.tables where table_schema='problem' ";

$res=mysqli_query($con,$q6);

while($row=mysqli_fetch_array($res))
{
  error_reporting(0);
  echo '<form action="test.php" method="POST"> <input type="hidden" name="pb" value="' . htmlspecialchars($row[table_name]) . '" /><input type="submit" value=" ' . htmlspecialchars($row[table_name]) .'  "/></form>'."<br>";
}
*/

 
?>





</div>




<div class="col-sm-4">

<br><br>

<div class="sidebar">

<div class="menu">
<b>Dashboard</b>
<?php echo("<center><h2 id=\"demo\" class=\"btn btn-primary btn-lg\"></h2></center><br>");?>
</div>
<?php


if(isset($_GET['name']))
{
  $n=$_GET['name'];
  $q3="SELECT id FROM rapl_oj_contest WHERE cname='$n'";

    $r=mysqli_query($con,$q3);

   $r1=mysqli_fetch_array($r);

   $conid=$r1['id'];

   $sql="SELECT sname, SUM(status) As Solved, SUM(point) As Points FROM submission Where cid='$conid' GROUP BY sname ORDER BY Solved DESC , Points DESC";

   $send=mysqli_query($con,$sql);
   $i=0;
   while($bow=mysqli_fetch_array($send))
   {
       $i++;

       if($bow['sname']==$username)
       {
          echo "<div class=\"row\"><div class=\"col-sm-12\"><a href=\"standings.php?id=$r1[id]\"><span class=\"pad btn btn-success\"><i class=\"fa fa-trophy\"></i>    $username 's Rank =$i</span></center></a></div></div>";
          break;
       }
   }
  
   echo("<a href=\"contestsubmission.php?id=$r1[id]\"><span class=\"pad btn btn-primary\">Submissions</span></a>");
    echo("<div style=\"margin-right:5px;\"><a href=\"standings.php?id=$r1[id]\"><div class=\"pad btn btn-primary\"> Standings </div></a></div><br><br><br>");


  $conid=$r1['id'];

    $q3="SELECT * FROM rapl_oj_contest WHERE id='$conid'";
    $sq3=mysqli_query($con,$q3);

      $q4="SELECT TIME_FORMAT(end_at,'%H') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";
       $q5="SELECT TIME_FORMAT(end_at,'%i') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";
        $q6="SELECT TIME_FORMAT(end_at,'%s') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";


      $sq4=mysqli_query($con,$q4);
      $sq5=mysqli_query($con,$q5);
      $sq6=mysqli_query($con,$q6);
      
      $i=0;


      
   
  while($timerow=mysqli_fetch_array($sq3))
    {
      $d=date("Y-m-d");
      $t=date("H:i:s");
      $current=date("Y-m-d H:i:s ");

      $m=$timerow['start_at'];
      $nv=$timerow['start_at'];


      $i++;
      $demo="demo".$i;
      $nr=mysqli_fetch_array($sq4);
      $nm=mysqli_fetch_array($sq5);
      $ns=mysqli_fetch_array($sq6);
      
      $shr=$nr['end_at'];
      $shm=$nm['end_at'];
      $shs=$ns['end_at'];
      $cur=date('H');
      $curm=date('i');
      $curs=date('s');

      $h=$shr-$cur;
      $mt=$shm-$curm;
      $scnd=$shs-$curs;

      if($scnd<0)
      {
         $scnd=$scnd+60;
         $mt=$mt-1;
      }

      if($mt<0)
      {
        $mt=$mt+60;
        $h=$h-1;
      }

      if($h<0)
      {
        $h=$h+24;
      }
      
      $en=$timerow['end_at'];

      $seconds = strtotime($t) - strtotime($m);
      $ss= strtotime($en) - strtotime($t);
      $min=intval($seconds/60);
      $sec=intval($seconds%60);
      $hr=intval($min/60);
      $m=intval($min%60);



   ?>
      
    <script type="text/javascript">
    var end=<?php print json_encode($en);?>; 
    var val=<?php print json_encode($i);?>; 
    var nv=<?php print json_encode($nv);?>; 

    //console.log("Start" +nv);

    call(end,val,nv);


   </script>
      
    <?php

     $diff=strtotime($nv)-strtotime($current);
     $current=strtotime($current);
     
    // echo "$current<br>";

     //echo "$diff";

     if($diff>0 && $access==0)
     {
         
         header("Location:countdown.php?name=$n");

     }

     echo("<div style=\"border:1px solid gray; padding:10px; border-radius:0px;\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$timerow[cname]</a><br><br>Contest Date: $timerow[date_on] <br><br>Start Time: $timerow[start_at]<br><br>End Time: $timerow[end_at] <br><br><div id=$demo></div> <br><br></div>");

   
     

     
      
       
 
    }
}



?>

</div>
</div>
</div>
</div>


</div><br><br><br><br><br><br>

<?php

require_once("footer.php");

?>


</body>
</html>
